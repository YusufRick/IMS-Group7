<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Product;
use App\Models\User;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BranchController extends Controller
{
    // Get all branches
    public function index()
    {
        return response()->json(Branch::all());
    }

    // Show a single branch by ID
    public function show($branchId)
    {
        $branch = Branch::findOrFail($branchId);
        return response()->json($branch);
    }

    // Get products for a specific branch
    public function getProducts($branchId)
    {
        $products = Product::whereHas('inventory', function ($query) use ($branchId) {
            $query->where('branch_id', $branchId);
        })->get();

        return response()->json($products);
    }

    // Get all users associated with a branch
    public function getUsers($branchId)
    {
        $users = User::where('branch_id', $branchId)->get();
        return response()->json($users);
    }

    // Get all sales for a specific branch
    public function getSales($branchId)
    {
        $sales = Sale::where('branch_id', $branchId)
            ->with(['user', 'items.product'])
            ->get();

        return response()->json($sales);
    }

    // Get a specific sale by sale ID
    public function getSale($branchId, $saleId)
    {
        $sale = Sale::where('branch_id', $branchId)
            ->where('sale_id', $saleId)
            ->with(['user', 'items.product'])
            ->firstOrFail();

        return response()->json($sale);
    }

    // Get all sales made by a specific user within a branch
    public function getUserSales($branchId, $userId)
    {
        $sales = Sale::where('branch_id', $branchId)
            ->where('user_id', $userId)
            ->with('items.product')
            ->get();

        return response()->json($sales);
    }

    // Create a new sale
    public function storeSale(Request $request, $branchId, $userId)
    {
        // Validate the incoming request
        $request->validate([
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);
    
        return DB::transaction(function () use ($request, $branchId, $userId) {
            // Create a new sale for the specified branch and user
            $sale = Sale::create([
                'branch_id' => $branchId,
                'user_id' => $userId, // Store user_id from the URL
                'total_amount' => 0,
                'sale_date' => now(),
            ]);
    
            $totalAmount = 0;
    
            // Process each item in the sale
            foreach ($request->items as $item) {
                // Find the inventory record for the product in the given branch
                $inventory = Inventory::where('branch_id', $branchId)
                    ->where('product_id', $item['product_id'])
                    ->first();
    
                // Check if inventory exists and has sufficient quantity
                if (!$inventory || $inventory->quantity < $item['quantity']) {
                    return response()->json([
                        'message' => 'Insufficient stock for product ID ' . $item['product_id'],
                    ], 400);
                }
    
                // Decrement the inventory quantity
                $inventory->decrement('quantity', $item['quantity']);
                
                // Get the product price from the inventory relationship
                $price = $inventory->product->price;
                
                // Create a sale item record
                $sale->items()->create([
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $price,
                ]);
    
                // Calculate total amount
                $totalAmount += $price * $item['quantity'];
            }
    
            // Update the sale with the total amount
            $sale->update(['total_amount' => $totalAmount]);
    
            // Return the sale with user and items information
            return response()->json($sale->load('user', 'items.product'), 201);
        });
    }
}
