<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BranchController extends Controller
{
    // Display the list of branches with DataTables
    public function index()
    {
        return view('branch.index');
    }

    // Fetch the branches for DataTables
    public function getBranches(Request $request)
    {
        if ($request->ajax()) {
            $branches = Branch::where('status','active')->select(['branch_id', 'branch_name', 'location', 'contact_number']);
            return DataTables::of($branches)
                ->addColumn('action', function ($branch) {
                    return '
                        <a href="' . route('branches.edit', $branch->branch_id) . '" class="btn btn-sm btn-primary">Edit</a>
                        <button class="btn btn-sm btn-danger delete-branch" data-id="' . $branch->branch_id . '">Delete</button>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    // Show the form for creating a new branch
    public function create()
    {
        return view('branch.create');
    }

    // Store a new branch in the database
    public function store(Request $request)
    {
        $request->validate([
            'branch_name' => 'required|string|max:255',
            'contact_number' => 'nullable|string|max:15',
            'location' => 'nullable|string|max:255',
        ]);

        Branch::create([
            'branch_name' => $request->branch_name,
            'location' => $request->location,
            'contact_number' => $request->contact_number,
        ]);

        return redirect()->route('branches.index')->with('success', 'Branch created successfully.');
    }

    // Show the form for editing a branch
    public function edit($id)
    {
        $branch = Branch::findOrFail($id);
        return view('branch.edit', compact('branch'));
    }
    public function show($id)
    {
        $branch = Branch::findOrFail($id);
        return view('branch.edit', compact('branch'));
    }
    // Update an existing branch
    public function update(Request $request, $id)
    {
        $request->validate([
            'branch_name' => 'required|string|max:255',
            'contact_number' => 'nullable|string|max:15',
            'location' => 'nullable|string|max:255',
        ]);

        $branch = Branch::findOrFail($id);
        $branch->update($request->only(['branch_name', 'location', 'contact_number']));

        return redirect()->route('branches.index')->with('success', 'Branch updated successfully.');
    }

    // Delete a branch
    public function destroy($id)
    {
        $branch = Branch::findOrFail($id);
        $branch->delete();

        return response()->json(['success' => true]);
    }
}
