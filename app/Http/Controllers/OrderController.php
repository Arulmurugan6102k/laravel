<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\ProductType;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use App\Exports\OrdersExport;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Maatwebsite\Excel\Facades\Excel;
use Log;

use PDF;



class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        // Check if the request wants JSON response
        if ($request->has('prod_type_name_id')) {
            $prod_type_name_id = $request->input('prod_type_name_id');


            $availableProducts = Product::where('prod_type_name', $prod_type_name_id)->get();
            // Sanitize and encode data before returning as JSON
            $encodedProducts = $availableProducts->map(function ($product) {
                return [
                    'id' => $product->id,
                    'product_name' => utf8_encode($product->product_name),
                    'product_cost' => utf8_encode($product->product_cost),
                ];
            });


            return response()->json($encodedProducts);
        }

        // Otherwise, render the view
        $productTypesName = ProductType::all()
            ->where('is_active', 1)
            ->where('is_deleted', 0);
        $countries = Country::all();
        return view('auth.addorder', compact('countries', 'productTypesName'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //    Validate incoming request data        
        $request->validate([
            'customer_name' => 'required',
            'customer_email' => 'required',
            'mobile_no' => 'required',
            'country_id' => 'required',
            'prod_type_id' => 'required',
            'products_id' => 'required',
        ]);


        // Create new product
        Order::create([
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_mob_no' => $request->mobile_no,
            'customer_country_id' => $request->country_id,
            'product_type_id' => $request->prod_type_id,
            'products_id' => $request->products_id,
            'order_amount' => $request->product_cost,

        ]);


        return redirect()->route('dashboard')->with('success', 'Order added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $order = Order::where('id', $id)->first();
        $storedProductIds = $order->products_id;
        $productTypesName = ProductType::all()
            ->where('is_active', 1)
            ->where('is_deleted', 0);
        $countries = Country::all();
        return view('auth.editorder', compact('order', 'productTypesName', 'countries', 'storedProductIds'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'customer_name' => 'required',
            'customer_email' => 'required',
            'mobile_no' => 'required',
            'country_id' => 'required',
            'prod_type_id' => 'required',
            'products_id' => 'required',
        ]);

        $order = Order::findOrFail($id);
        $order->customer_name = $request->customer_name;
        $order->customer_email = $request->customer_email;
        $order->customer_mob_no = $request->mobile_no;
        $order->customer_country_id = $request->country_id;
        $order->product_type_id = $request->prod_type_id;
        $order->products_id = $request->products_id;
        $order->order_amount = $request->product_cost;
        $order->save();

        return redirect()->route('dashboard')->with('success', 'Order updated successfully.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('orders')
            ->where('id', $id)
            ->update(['is_deleted' => 1]);

        return redirect()->route('dashboard')->with('success', 'Order deleted successfully');
    }


    public function generatePdf(string $id, $products_id)
    {
        
        // Query the orders table with a left join on product_types and countries
        $firstResults = DB::table('orders')
            ->leftJoin('product_types', 'orders.product_type_id', '=', 'product_types.main_id')
            ->leftJoin('countries', 'orders.customer_country_id', '=', 'countries.id')
            ->select('orders.*', 'product_types.*', 'countries.name as country_name')
            ->where('orders.is_deleted', 0)
            ->where('orders.id', $id);
    
        $firstResults = $firstResults->get();
    
        // Query the product_types table with a right join on orders and countries
        $secondResults = DB::table('product_types')
            ->rightJoin('orders', 'orders.product_type_id', '=', 'product_types.main_id')
            ->leftJoin('countries', 'orders.customer_country_id', '=', 'countries.id')
            ->select('orders.*', 'product_types.*', 'countries.name as country_name')
            ->where('orders.is_deleted', 0)
            ->where('orders.id', $id);
    
        $secondResults = $secondResults->get();
        
        // Combine results into a single collection and ensure distinct values
        $results = $firstResults->merge($secondResults)
            ->unique('id') // id for uniqueness
            ->sortByDesc('id') // id for sorting
            ->values();
         
        $countries = \DB::table('countries')->pluck('name', 'id')->toArray();

        $productIdsArray = explode(',', $products_id); // Convert to array
        // Query products based on the IDs provided
        $products = Product::whereIn('id', $productIdsArray)->get();


        foreach ($products as $product) {
                if (!empty($product->product_image)) {
                    $product->product_image_base64 = base64_encode($product->product_image);
                } else {
                    $product->product_image_base64 = null;
                }
        }

        
        $pdf = PDF::loadView('auth.downloadPDF', [
            'orders_results' => $results,
            'produts_data' => $products,
            'countries' => $countries,
        ]);


    
        return $pdf->download('table.pdf');
    }

    public function export(Request $request)
    {
        
        $orderIds = $request->input('order_ids');
        return Excel::download(new OrdersExport($orderIds), 'orders.xlsx');

    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx'
        ]);

        $file = $request->file('file');
        $spreadsheet = IOFactory::load($file->getPathname());
        $worksheet = $spreadsheet->getActiveSheet();

        foreach ($worksheet->getRowIterator() as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);

            $data = [];
            foreach ($cellIterator as $cell) {
                $data[] = $cell->getValue();
            }

            // Assuming the first row is the header
            if ($row->getRowIndex() === 1) {
                continue;
            }

            // Convert product names to IDs
            $productNames = explode(',', $data[8]); // Assuming product names are in the ninth column

            $productIds = [];
            foreach ($productNames as $productName) {
                // Query product by name
                $productName = trim($productName); // Trim whitespace from product name
                $product = Product::where('product_name', $productName)->first();
                if ($product) {
                    $productIds[] = $product->id;
                } else {
                    // Log product not found
                    Log::warning("Product with name '{$productName}' not found in the database.");
                    // You can handle this case according to your application's requirements
                }
            }

            // Convert product IDs to JSON string
            $productIdsJson = json_encode($productIds);

            // Convert country name to ID
            $countryName = $data[6]; // Assuming country name is in the seventh column
            $country = Country::where('name', $countryName)->first();
            $countryId = $country ? $country->id : null;

            // Convert product type name to ID
            $productTypeName = $data[7]; // Assuming product type name is in the eighth column
            $productType = ProductType::where('product_type_name', $productTypeName)->first();
            $productTypeId = $productType ? $productType->main_id : null;

            // Insert into database
            Order::create([
                'products_id' => $productIdsJson, // Store product IDs as JSON string
                'order_no' => $data[1],
                'customer_name' => $data[2],
                'customer_email' => $data[3],
                'customer_mob_no' => $data[4],
                'customer_country_id' => $countryId,
                'product_type_id' => $productTypeId,
                'order_amount' => $data[5],
                // 'product_name' => $data[1],
                // 'cost' => $data[3], // Assuming cost is in the fourth column
            ]);

            // Clear product IDs array for next iteration
            $productIds = [];
        }

        return redirect()->route('dashboard')->with('success', 'Order updated successfully.');
    }
    }
