<?php

namespace App\Http\Controllers;
use App\Models\ProductType;
use App\Models\Branch;
use App\Models\ProductBranch;
use Illuminate\Http\Request;


class ProductBranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $productTypes = productType::all();
        $branches = Branch::all();
        $ProductBranches = ProductBranch::all();
        return view('auth.showproductbranch', compact('productTypes', 'branches', 'ProductBranches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productTypeName = productType::all();
        $branchName = Branch::all();
        $ProductBranches = ProductBranch::all();
        return view('auth.addproductbranch', compact('productTypeName', 'branchName', 'ProductBranches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $products = $request->input('products');

        foreach ($products as $product) {
            ProductBranch::updateOrCreate(
                ['product_type_id' => $product['product_id'],
                 'branch_id' => $product['branch_id']
                ],
                ['status' => $product['status']]
            );
        }

        return response()->json(['message' => 'Product branches updated successfully']);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
