<?php

namespace App\Http\Controllers;
use App\Models\Branch;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Inventory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Retrieve the authenticated user
        $user = Auth::user();
        $branchId = $user->branch_id;  // Assumes branch_id is a column in the users table

        // Tiles Data
        $totalSales = Sale::when($branchId, function ($query) use ($branchId) {
            return $query->where('branch_id', $branchId);
        })->sum('total_amount');

        $totalProducts = Product::count();

        $totalBranches = Branch::count();

        $topProduct = Product::select('product_name')
            ->withSum(['salesItems as quantity_sold' => function ($query) use ($branchId) {
                if ($branchId) {
                    $query->whereHas('sale', fn ($q) => $q->where('branch_id', $branchId));
                }
            }], 'quantity')
            ->orderByDesc('quantity_sold')
            ->first();

        // Graph Data
        $salesByBranch = Sale::select('branch_id', DB::raw('SUM(total_amount) as total_sales'))
            ->when($branchId, function ($query) use ($branchId) {
                return $query->where('branch_id', $branchId);
            })
            ->groupBy('branch_id')
            ->with('branch')
            ->get();
            $monthlySales = Sale::select(
                DB::raw('MONTH(sale_date) as month'),
                DB::raw('SUM(total_amount) as total_sales')
            )
            ->when($branchId, function ($query) use ($branchId) {
                return $query->where('branch_id', $branchId);
            })
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->map(function ($sale) {
                // Convert month number to full month name
                $sale->month = Carbon::create()->month($sale->month)->format('F');
                return $sale;
            });

        $topProducts = Product::select('id', 'product_name')
            ->withCount(['salesItems as sold_quantity' => function ($query) use ($branchId) {
                if ($branchId) {
                    $query->whereHas('sale', fn ($q) => $q->where('branch_id', $branchId));
                }
            }])
            ->orderByDesc('sold_quantity')
            ->take(5)
            ->get();

        return view('admin.dashboard', [
            'tiles' => [
                'totalSales' => $totalSales,
                'totalProducts' => $totalProducts,
                'totalBranches' => $totalBranches,
                'topProduct' => $topProduct->product_name ?? 'N/A'
            ],
            'graphs' => [
                'salesByBranch' => $salesByBranch,
                'monthlySales' => $monthlySales,
                'topProducts' => $topProducts
            ]
        ]);
    }
}
