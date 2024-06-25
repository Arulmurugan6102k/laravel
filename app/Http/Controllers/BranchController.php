<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Branch;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches = Branch::all();
        return view('auth.showbranch', compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.addbranch');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'branch_name' => 'required',
        ]);

        $branchPrefix = strtoupper(substr($request->branch_name, 0, 3));
          
        $branch = Branch::create([
            'branch_name' => $request->branch_name,
            'branch_prefix' => $branchPrefix,
        ]);

        return redirect()->route('branches.index')->with('success', 'Order added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $branch = Branch::find($id);
        return view('auth.editbranch', compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'branch_name' => 'required',
        ]);
        $branch = Branch::find($id);
        $branch->branch_name = $request->branch_name;
        $branch->save();

        return redirect()->route('branches.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $branch = Branch::findOrFail($id);
        $branch->delete();

        // Optionally, you can return a response or redirect back with a message
        return response()->json(['message' => 'branch deleted successfully']);
    }
}
