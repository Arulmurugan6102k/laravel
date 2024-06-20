<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Support\Facades\DB;



class ProductController extends Controller
{ 
    public function add(Request $request) {

    //    Validate incoming request data
       $request->validate([
        'product_name' => 'required|string|max:255',
        'product_cost' => 'required|numeric',
        'product_type_name' => 'required|numeric',
        'release_date' => 'required|date',
        'current_version' => 'required|string',
        'product_description' => 'required|string',
        'available_colors' => 'required',
        ]);

        
        
        // Handle file upload if there's an image
        if ($request->has('cropped_image_data')) {
            // Decode base64 data to binary (blob)
            $base64Image = $request->input('cropped_image_data');
            $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Image));
        }
    
        // Create new product
        Product::create([
            'product_name' => $request->product_name,
            'product_cost' => $request->product_cost,
            'prod_type_name' => $request->product_type_name,
            'release_date' => $request->release_date,
            'version_id' => $request->current_version,
            'product_image' => !empty($image) ? $image : null,
            'product_description' => $request->product_description,
            'available_colors' => json_encode($request->available_colors)
        ]);  


        return redirect()->route('showprod')->with('success', 'Product added successfully.');
        
    }

    public function edit(Request $request, $id)
    {
        // Validate incoming request data
        $request->validate([
            'product_name' => 'string|max:255',
            'product_cost' => 'numeric',
            'product_type_name' => 'required',
            'release_date' => 'nullable|date',
            'current_version' => 'string',
            'cropped_image_data' => 'string|nullable',
            'product_description' => 'nullable|string',
            'available_colors' => 'nullable',
        ]);
        
        // Find the product by its ID
        $product = Product::find($id);


        // Handle file upload if there's an image
        if ($request->has('cropped_image_data') && strlen($request->input('cropped_image_data')) > 100) {
            // Decode base64 data to binary (blob)
            $base64Image = $request->input('cropped_image_data');
            $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Image));
            $product->product_image = $image;
        }

        // Update product fields
        $product->product_name = $request->product_name;
        $product->product_cost = $request->product_cost;
        $product->prod_type_name = $request->product_type_name;
        $product->release_date = $request->release_date;
        $product->version_id = $request->current_version;
        $product->product_description = $request->product_description;
        $product->available_colors = json_encode($request->available_colors);

        // Save the updated product
        $product->save();

        return redirect()->route('showprod', $id )->with('success', 'Product updated successfully.');
    }
    
    public function delete(Request $request, $id)
    {
        // Find the product by ID and set its is_deleted to 1
        DB::table('products')
            ->where('id', $id)
            ->update(['is_deleted' => 1]);

            // return redirect()->route('showprodtype')->with('success', 'Product deleted successfully.');
    }

    public function addtype(Request $request) 
    {
        //  Validate incoming request data
       $request->validate([
        'product_type_name' => 'required|string|max:255',
        'product_type_code' => 'required|numeric',
        'product_status' => 'required|boolean'
        ]);

        ProductType::create([
            'product_type_name' => $request->product_type_name,
            'product_type_code' => $request->product_type_code,
            'is_active' => $request->product_status
        ]);  
        
        return redirect()->route('showprodtype')->with('success', 'Product type added successfully.');
    }

    public function edittype(Request $request, $id) 
    {

        //  Validate incoming request data
       $request->validate([
        'product_type_name' => 'required|string|max:255',
        'product_type_code' => 'required|numeric',
        'product_status' => 'required|boolean'
        ]);
        
    //     // Find the product by its ID
        $productType = ProductType::where('main_id', $id)->first();

    //     // Update product fields
        $productType->product_type_name = $request->product_type_name;
        $productType->product_type_code = $request->product_type_code;
        $productType->is_active = $request->product_status;

    //     // Save the updated product
        $productType->save();

        return redirect()->route('showprodtype', $id)->with('success', 'Product type updated successfully.');

    }
    public function deletetype(Request $request, $id)
    {
        // Find the product by ID and set its is_deleted to 1
        DB::table('product_types')
            ->where('main_id', $id)
            ->update(['is_deleted' => 1]);


            return redirect()->route('showprodtype')->with('success', 'Product type deleted successfully.');
    }
    
}


