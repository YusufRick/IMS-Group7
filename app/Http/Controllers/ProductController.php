<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Branch;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    // Display the list of products with DataTables
    public function index()
    {
        return view('products.index');
    }

    // Fetch the products for DataTables
    public function getProducts(Request $request)
    {
        if ($request->ajax()) {
            // Fetch products along with branch data
            $branch_id=auth()->user()->branch_id;
            $productsQuery = Product::with('branch')->select(['id', 'product_name', 'sku', 'price', 'category', 'branch_id']);

            // Filter based on authenticated user's branch_id
            if ($branch_id) {
                $productsQuery->where('branch_id', $branch_id);
            }

            return DataTables::of($productsQuery)
                ->addColumn('branch', function ($product) {
                    return $product->branch ? $product->branch->branch_name : 'No Branch'; // Display branch name
                })
                ->addColumn('action', function ($product) {
                    return '
                        <a href="' . route('products.edit', $product->id) . '" class="btn btn-sm btn-primary">Edit</a>
                        <button class="btn btn-sm btn-danger delete-product" data-id="' . $product->id . '">Delete</button>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    // Show the form for creating a new product
    public function create()
    {
        $branches = Branch::all(); // Get all branches for the product
        return view('products.create', compact('branches'));
    }

    // Store a new product in the database
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'sku' => 'required|string|unique:products,sku',
            'price' => 'required|numeric',
            'category' => 'nullable|string|max:255',
            'branch_id' => 'nullable|exists:branches,branch_id', // Ensure branch exists
        ]);

        Product::create($request->only(['product_name', 'sku', 'price', 'category', 'branch_id','description']));

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    // Show the form for editing a product
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $branches = Branch::all(); // Get all branches for the product
        return view('products.edit', compact('product', 'branches'));
    }

    // Update an existing product
    public function update(Request $request, $id)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'sku' => 'required|string|unique:products,sku,'.$id.',id', // Ensure unique SKU except for the current product
            'price' => 'required|numeric',
            'category' => 'nullable|string|max:255',
            'branch_id' => 'nullable|exists:branches,branch_id', // Ensure branch exists
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->only(['product_name', 'sku', 'price', 'category', 'branch_id','description']));

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    // Delete a product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['success' => true]);
    }

    public function show($id)
    {
        $branch = Product::findOrFail($id);
        return view('products.edit', compact('branch'));
    }
}

