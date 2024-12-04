<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Product;
use App\Models\Branch;
use App\Models\Sale;
use App\Models\SalesItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class InventoryController extends Controller
{
    // Display the list of inventories with DataTables
    public function index()
    {
        return view('inventories.index');
    }

    // Fetch the inventories for DataTables
    public function getInventories(Request $request)
    {
        if ($request->ajax()) {
            $branch_id = auth()->user()->branch_id;
            $inventoriesQuery = Inventory::with(['branch', 'product'])->select(['inventory_id', 'product_id', 'branch_id', 'quantity', 'min_quantity']);

            if ($branch_id) {
                $inventoriesQuery->where('branch_id', $branch_id);
            }
            return DataTables::of($inventoriesQuery)
                ->addColumn('branch', function ($inventory) {
                    return $inventory->branch ? $inventory->branch->branch_name : 'No Branch';
                })
                ->addColumn('product', function ($inventory) {
                    return $inventory->product ? $inventory->product->product_name : 'No Product';
                })
                ->addColumn('action', function ($inventory) {
                    return '
                        <a href="' . route('inventory.edit', $inventory->inventory_id) . '" class="btn btn-sm btn-primary">Edit</a>
                        <button class="btn btn-sm btn-danger delete-inventory" data-id="' . $inventory->inventory_id . '">Delete</button>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    // Show form for creating a new inventory
    public function create()
    {
        $branches = Branch::all();
        $products = Product::all();
        return view('inventories.create', compact('branches', 'products'));
    }

    // Store a new inventory in the database
    public function store(Request $request)
    {
        $request->validate([
            'branch_id' => 'nullable|exists:branches,branch_id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer',
            'min_quantity' => 'required|integer',
        ]);
    
        // Check if an inventory entry already exists for this branch and product
        $inventory = Inventory::where('branch_id', $request->branch_id)
                              ->where('product_id', $request->product_id)
                              ->first();
    
        if ($inventory) {
            // If the entry exists, increment the quantity
            $inventory->quantity += $request->quantity;
            $inventory->min_quantity = $request->min_quantity;
            $inventory->save();
            $message = 'Inventory quantity updated successfully.';
        } else {
            // If no entry exists, create a new inventory record
            Inventory::create($request->only(['branch_id', 'product_id', 'quantity', 'min_quantity']));
            $message = 'Inventory created successfully.';
        }
    
        return redirect()->route('inventory.index')->with('success', $message);
    }

    // Show the form for editing an inventory
    public function edit($id)
    {
        $inventory = Inventory::findOrFail($id);
        $branches = Branch::all();
        $products = Product::all();
        return view('inventories.edit', compact('inventory', 'branches', 'products'));
    }

    // Update an existing inventory
    public function update(Request $request, $id)
    {
        $request->validate([
            'branch_id' => 'nullable|exists:branches,branch_id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer',
            'min_quantity' => 'required|integer',
        ]);
    
        $inventory = Inventory::findOrFail($id);
        $inventory->update($request->only(['branch_id', 'product_id', 'quantity', 'min_quantity']));
    
        return redirect()->route('inventory.index')->with('success', 'Inventory updated successfully.');
    }

    // Delete an inventory
    public function destroy($id)
    {
        $inventory = Inventory::findOrFail($id);
        $inventory->delete();

        return response()->json(['success' => true]);
    }
    public function storeSale(Request $request, $branch_id, $user_id)
    {
        try {
            // Decrypt the branch and user IDs
            $branch_id = $branch_id;
            $user_id = $user_id;
        } catch (\Exception $e) {
            return response()->json(['error' => 'Invalid parameters'], 400);
        }

        // Validate the rest of the request data
        $request->validate([
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
        ]);

        // Verify the branch and user relationship or permissions as needed
        $user = User::find($user_id);
        if (!$user || $user->branch_id !== (int)$branch_id) {
            return response()->json(['error' => 'User does not belong to this branch'], 403);
        }

        DB::beginTransaction();
        try {
            // Calculate the total amount
            $total_amount = collect($request->items)->sum(fn($item) => $item['price'] * $item['quantity']);

            // Create the sale record with decrypted branch_id and user_id
            $sale = Sale::create([
                'branch_id' => $branch_id,
                'user_id' => $user_id,
                'total_amount' => $total_amount,
                'sale_date' => now(),
            ]);

            // Process each item in the sale
            foreach ($request->items as $item) {
                $inventory = Inventory::where('branch_id', $branch_id)
                                      ->where('product_id', $item['product_id'])
                                      ->first();

                if (!$inventory || $inventory->quantity < $item['quantity']) {
                    throw new \Exception("Insufficient stock for product ID {$item['product_id']}");
                }

                // Deduct the quantity from inventory
                $inventory->quantity -= $item['quantity'];
                $inventory->save();

                // Add each item to the sale
                SalesItem::create([
                    'sale_id' => $sale->sale_id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            DB::commit();
            return response()->json(['message' => 'Sale successfully created.'], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}

