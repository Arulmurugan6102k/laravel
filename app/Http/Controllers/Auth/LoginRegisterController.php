<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class LoginRegisterController extends Controller
{

    // Instantiate a new LoginRegisterController instance.
    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout', 'dashboard', 'addprod', 'addprodtype', 'editprod', 'editprodtype', 'addorder', 'showprod', 'showprodtype', 'addorder', 'fetchProducts'
        ]);
    }


    //Display a registration form.

    public function register()
    {    
        return view('auth.register');
    }

    // storig the new user
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        $request->session()->regenerate();
        return redirect()->route('dashboard')
        ->withSuccess('You have successfully registered & logged in!');
    }


     // Display a login form.

    public function login()
    {
        return view('auth.login');
    }

     //Authenticate the user.

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials))
        {
            $request->session()->regenerate();
            return redirect()->route('dashboard')
                ->withSuccess('You have successfully logged in!');
        }

        return back()->withErrors([
            'email' => 'Your provided credentials do not match in our records.',
        ])->onlyInput('email');

    } 
    

     // Display a dashboard to authenticated users.
     public function dashboard(Request $request)
     {
         if (Auth::check()) {
     
             $searchTerm = $request->input('product_search');
             $priceRange = $request->input('price_range');  
     
             // Query the orders table with a left join on product_types and countries
             $firstResults = DB::table('orders')
                 ->leftJoin('product_types', 'orders.product_type_id', '=', 'product_types.main_id')
                 ->leftJoin('countries', 'orders.customer_country_id', '=', 'countries.id')
                 ->select('orders.*', 'product_types.*', 'countries.name as country_name')
                 ->where('orders.is_deleted', 0);
     
             if ($searchTerm) {
                 $firstResults->where(function ($query) use ($searchTerm) {
                     $query->where('orders.customer_name', 'LIKE', '%' . $searchTerm . '%')
                           ->orWhere('orders.customer_email', 'LIKE', '%' . $searchTerm . '%')
                           ->orWhere('orders.customer_mob_no', 'LIKE', '%' . $searchTerm . '%')
                           ->orWhere('countries.name', 'LIKE', '%' . $searchTerm . '%')
                           ->orWhere('product_types.product_type_name', 'LIKE', '%' . $searchTerm . '%');
                 });
             }
     
             if ($priceRange) {
                 $firstResults->where('orders.order_amount', '>', $priceRange);
             }
     
             $firstResults = $firstResults->get();
     
             // Query the product_types table with a right join on orders and countries
             $secondResults = DB::table('product_types')
                 ->rightJoin('orders', 'orders.product_type_id', '=', 'product_types.main_id')
                 ->leftJoin('countries', 'orders.customer_country_id', '=', 'countries.id')
                 ->select('orders.*', 'product_types.*', 'countries.name as country_name')
                 ->where('orders.is_deleted', 0);
     
             if ($searchTerm) {
                 $secondResults->where(function ($query) use ($searchTerm) {
                     $query->where('orders.customer_name', 'LIKE', '%' . $searchTerm . '%')
                           ->orWhere('orders.customer_email', 'LIKE', '%' . $searchTerm . '%')
                           ->orWhere('orders.customer_mob_no', 'LIKE', '%' . $searchTerm . '%')
                           ->orWhere('countries.name', 'LIKE', '%' . $searchTerm . '%')
                           ->orWhere('product_types.product_type_name', 'LIKE', '%' . $searchTerm . '%');
                 });
             }
     
             if ($priceRange) {
                 $secondResults->where('orders.order_amount', '>', $priceRange);
             }
     
             $secondResults = $secondResults->get();
     
             // Combine results into a single collection and ensure distinct values
             $results = $firstResults->merge($secondResults)
                                     ->unique('id') // id for uniqueness
                                     ->sortByDesc('id') //  id for sorting
                                     ->values();
     
             // Convert products_id to comma-separated strings
             $results->transform(function ($item) {
                 if (isset($item->products_id)) {
                     $productsArray = json_decode($item->products_id, true);
                     if (is_array($productsArray)) {
                         $item->products_id = implode(', ', $productsArray);
                     }
                 }
                 return $item;
             });
     
             // Paginate results
             $perPage = 1;
             $currentPage = \Illuminate\Pagination\Paginator::resolveCurrentPage();
             $path = \Illuminate\Pagination\Paginator::resolveCurrentPath();
             $paginatedResults = new \Illuminate\Pagination\LengthAwarePaginator(
                 $results->forPage($currentPage, $perPage),
                 $results->count(),
                 $perPage,
                 $currentPage,
                 ['path' => $path]
             );
             $countries = \DB::table('countries')->pluck('name', 'id')->toArray();
             return view('auth.dashboard', compact('paginatedResults', 'countries'));
         }
     
         return redirect()->route('login'); // Redirect to login if not authenticated
     }
     

     
     
     public function fetchProducts(Request $request)
     {
         // Validate incoming request to ensure 'ids' parameter exists
         $request->validate([
             'ids' => 'required|array',
         ]);
 
         // Retrieve product IDs from the request
         $ids = $request->input('ids');
 
         // Query products based on the IDs provided
         $products = Product::whereIn('id', $ids)->get();
 
         // Prepare JSON response with necessary data
         $formattedProducts = $products->map(function ($product) {
             return [
                 'id' => $product->id,
                 'product_name' => $product->product_name,
                 'product_cost' => $product->product_cost,
                 'product_image' => base64_encode($product->product_image),
                 // Add more fields as needed
             ];
         });
 
         // Return JSON response with products data
         return response()->json(['products' => $formattedProducts]);
     }
 
     
     
     
     
     public function showprod(Request $request)
     {
         if (Auth::check()) {
             $searchTerm = $request->input('product_search');
             $priceRange = $request->input('price_range');
             $productStatus = $request->input('prod_status');
             $productDate = $request->input('prod_date');

     
             // Query the products table with a right join on product_types
             $firstResults = DB::table('products')
                 ->rightJoin('product_types', 'products.prod_type_name', '=', 'product_types.main_id')
                 ->select('products.*', 'product_types.*')
                 ->where('products.is_deleted', 0);
     
             // Add search conditions for prod_type_name and product_name
             if ($searchTerm) {
                 $firstResults->where(function ($query) use ($searchTerm) {
                     $query->where('product_types.product_type_name', 'LIKE', '%' . $searchTerm . '%')
                           ->orWhere('products.product_name', 'LIKE', '%' . $searchTerm . '%');
                 });
             }
     
             // Add filter conditions for price range
             if ($priceRange) {
                 $firstResults->where('products.product_cost', '>', $priceRange);
             }
     
             // Add filter conditions for product status
             if ($productStatus !== null) {
                 $firstResults->where('product_types.is_active', $productStatus);
             }

             // Add filter conditions for product date
             if ($productDate) {
                $firstResults->where('products.created_at', $productDate);
            }
     
             $firstResults = $firstResults->get();
     
             // Query the product_types table with a left join on products
             $secondResults = DB::table('product_types')
                 ->leftJoin('products', 'products.prod_type_name', '=', 'product_types.main_id')
                 ->select('products.*', 'product_types.*')
                 ->where('products.is_deleted', 0);
     
             // Add search conditions for prod_type_name and product_name
             if ($searchTerm) {
                 $secondResults->where(function ($query) use ($searchTerm) {
                     $query->where('product_types.product_type_name', 'LIKE', '%' . $searchTerm . '%')
                           ->orWhere('products.product_name', 'LIKE', '%' . $searchTerm . '%');
                 });
             }
     
             // Add filter conditions for price range
             if ($priceRange) {
                 $secondResults->where('products.product_cost', '>', $priceRange);
             }
     
             // Add filter conditions for product status
             if ($productStatus !== null) {
                 $secondResults->where('product_types.is_active', $productStatus);
             }

             if ($productDate) {
                $firstResults->where('products.created_at', $productDate);
            }
     
             $secondResults = $secondResults->get();
     
             // Combine results into a single collection and ensure distinct values
             $results = $firstResults->merge($secondResults)
                                     ->unique('id')
                                     ->sortByDesc('id')
                                     ->values();          
     
             // Paginate the combined results
             $perPage = 6;
             $currentPage = \Illuminate\Pagination\Paginator::resolveCurrentPage();
             $path = \Illuminate\Pagination\Paginator::resolveCurrentPath();
             $paginatedResults = new \Illuminate\Pagination\LengthAwarePaginator(
                 $results->forPage($currentPage, $perPage),
                 $results->count(),
                 $perPage,
                 $currentPage,
                 ['path' => $path]
             );
     
             return view('auth.showprod', compact('paginatedResults'));
         }
     
         return redirect()->route('login'); // Redirect to login if not authenticated
     }
     
     
     

    public function addprod()
    {
        if(Auth::check())
        {
            $productsType = ProductType::all()
           ->where('is_active', 0)
           ->where('is_deleted', 0);
           
            return view('auth.addprod', compact('productsType'));
        }
        
        return redirect()->route('login')
            ->withErrors([
            'email' => 'Please login to access the dashboard.',
        ])->onlyInput('email');
    } 

    public function editprod($id)
    {
        if(Auth::check())
        {
            $product = Product::find($id)
            ;// Fetch the product
           
            
            $productsType = ProductType::all() // Fetch all product types
            ->where('is_active', 0)
            ->where('is_deleted', 0);
            $availableColors = json_decode($product->available_colors, true); // Decode JSON to array
    
            return view('auth.editprod', compact('product', 'productsType', 'availableColors'));
        }
        
        return redirect()->route('login')
            ->withErrors([
            'email' => 'Please login to access the dashboard.',
        ])->onlyInput('email');
    }
    


    public function showprodtype(Request $request)
    {
        if (Auth::check()) {
            // Fetch filter and search inputs
            $searchTerm = $request->input('product_search');
            $prodStatus = $request->input('prod_status');
    
            // Base query for product types
            $query = ProductType::where('is_deleted', 0);
    
            // Apply search filter
            if ($searchTerm) {
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('product_type_name', 'LIKE', '%' . $searchTerm . '%');
                });
            }
    
    
            // adding product status filter
            if (isset($prodStatus)) {
                $query->where('is_active', $prodStatus);
            }
    
            // Fetch the results
            $productsType = $query->orderBy('main_id', 'DESC')->get();
    
            return view('auth.showprodtype', compact('productsType'));
        }
    
        return redirect()->route('login')
            ->withErrors([
                'email' => 'Please login to access the dashboard.',
            ])->onlyInput('email');
    }


    public function addprodtype(Request $request)
    {
        if (Auth::check()) {
            // Fetch filter and search inputs
            $searchTerm = $request->input('product_search');
            $prodStatus = $request->input('prod_status');
    
            // Base query for product types
            $query = ProductType::where('is_deleted', 0);
    
            // Apply search filter
            if ($searchTerm) {
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('product_type_name', 'LIKE', '%' . $searchTerm . '%');
                });
            }
    
    
            // adding product status filter
            if (isset($prodStatus)) {
                $query->where('is_active', $prodStatus);
            }
    
            // Fetch the results
            $productsType = $query->orderBy('main_id', 'DESC')->get();
    
            return view('auth.addprodtype', compact('productsType'));
        }
    
        return redirect()->route('login')
            ->withErrors([
                'email' => 'Please login to access the dashboard.',
            ])->onlyInput('email');
    }

    public function editprodtype($id)
    {
        if(Auth::check())
        {
            $productType = ProductType::where('main_id', $id)->first();
            return view('auth.editprodtype', compact('productType'));
        }
        return redirect()->route('login')
            ->withErrors([
            'email' => 'Please login to access the dashboard.',
        ])->onlyInput('email');
    } 
     // Log out the user from application.

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
            ->withSuccess('You have logged out successfully!');;
    }    


    public function gotodashboard()
    {
       
            return redirect()->route('dashboard');
      
    }  

    public function addorder() {
        return view('auth.addorder');
    }
    


}