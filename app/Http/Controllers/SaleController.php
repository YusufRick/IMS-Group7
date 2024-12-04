<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
class SaleController extends Controller
{
    public function index()
{
    return view('sales.index');
}
public function list(Request $request)
{
    if ($request->ajax()) {
        $branch_id = auth()->user()->branch_id;

        // Fetch sales with related user and branch data
        $salesQuery = Sale::with(['user', 'branch'])
            ->whereHas('user') // Only include sales where the user exists
            ->whereHas('branch'); // Only include sales where the branch exists

        // Apply the branch filter only if branch_id is not null
        if (!is_null($branch_id)) {
            $salesQuery->where('branch_id', $branch_id);
        }

        $sales = $salesQuery->get();

        return DataTables::of($sales)
            ->addColumn('sale_id', function($sale) {
                return $sale->sale_id; // Assuming 'id' is the primary key for Sale
            })
            ->addColumn('username', function($sale) {
                return $sale->user->first_name ?? 'No User'; // Assuming 'name' is the user attribute
            })
            ->addColumn('branch_name', function($sale) {
                return $sale->branch->branch_name ?? 'No Branch'; // Assuming 'branch_name' is the branch attribute
            })
            ->addColumn('action', function($sale) {
                $downloadLink = route('sales.downloadPdf', $sale->sale_id);
                $viewLink = route('sales.show', $sale->sale_id);
                return '<a href="' . $downloadLink . '" target="_blank" class="btn btn-primary"><i class="fa fa-file-pdf-o"></i></a>
                        <a href="' . $viewLink . '" target="_blank" class="btn btn-info"><i class="fa fa-eye"></i></a>';
            })
            ->rawColumns(['action'])
            // ->addColumn('action', function($sale) {
            //     return '<button data-id="'.$sale->id.'" class="btn btn-danger delete-sale">Delete</button>';
            // })
            ->rawColumns(['action'])
            ->make(true);
    }
}
public function downloadPdf($id)
{
    $sale = Sale::with(['user', 'branch', 'items.product'])->findOrFail($id);

    // Generate data for the PDF view
    $data = [
        'sale' => $sale,
        'branch' => $sale->branch->branch_name ?? 'Unknown Branch',
        'user' => $sale->user->first_name ?? 'Unknown User',
        'sale_date' => $sale->sale_date,
        'items' => $sale->items,
        'total_amount' => $sale->total_amount,
    ];

    // Load the PDF view with the sale data
    $pdf = Pdf::loadView('sales.sale_receipt', $data);

    // Download the PDF with a filename based on the sale ID
    return $pdf->download('sale_receipt_' . $sale->id . '.pdf');
}
public function show($id)
{
    $sale = Sale::with(['user', 'branch', 'items.product'])->findOrFail($id);

    $data = [
        'sale' => $sale,
        'branch' => $sale->branch->branch_name ?? 'Unknown Branch',
        'user' => $sale->user->first_name ?? 'Unknown User',
        'sale_date' => $sale->sale_date,
        'items' => $sale->items,
        'total_amount' => $sale->total_amount,
    ];

    $pdf = Pdf::loadView('sales.sale_receipt', $data);

    return $pdf->stream('sale_receipt_' . $sale->id . '.pdf');
}
public function salesReport()
{
    return view('sales.report');
}

public function generateReport(Request $request)
{
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    $sales = Sale::whereBetween('sale_date', [$startDate, $endDate])->with(['user', 'branch'])->get();

    $totalAmount = $sales->sum('total_amount');

    $html = view('sales.partials.report_table', compact('sales', 'totalAmount'))->render();

    return response()->json(['html' => $html]);
}

public function downloadReport(Request $request)
{
    $startDate = $request->query('start_date');
    $endDate = $request->query('end_date');

    $sales = Sale::whereBetween('sale_date', [$startDate, $endDate])->with(['user', 'branch'])->get();

    $totalAmount = $sales->sum('total_amount');

    $pdf = Pdf::loadView('sales.pdf_report', compact('sales', 'totalAmount', 'startDate', 'endDate'))
              ->setPaper('a4', 'portrait');

    return $pdf->download('Sales_Report_' . $startDate . '_to_' . $endDate . '.pdf');
}
}
