<?php

namespace OneStop\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Product\Entities\Product;
use OneStop\Category;
use OneStop\Cart;
use OneStop\Notifications\NotifExample;

use DB, Auth, Shoppingcart, Notification;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function unauthorized(){
        return view('unauthorized');
    }

    public function detail($id)
    {
        $product = Product::findorFail($id);
        return view('detail', ['product' => $product]);
    }
    
    public function homedata(Request $request)
    {
        $data = array();

        $categories = Category::all(); 

        if($cat_id = $request->input('cat_id')){

            $category = Category::findOrFail($cat_id);
                
            $products = DB::table('product')->join('subcategory','subcategory.id','=','product.subcategory_id')
                        ->join('category', 'category.id','=','subcategory.category_id')
                        ->where('category.id','=', $category->id)
                        ->select('product.name','product.id', 'product.price', 'product.image')
                        ->get();
            
            $data[$category->name] = $products;            
            
            
        } else {

            foreach ($categories as $key => $category) {
                
                $products = DB::table('product')->join('subcategory','subcategory.id','=','product.subcategory_id')
                            ->join('category', 'category.id','=','subcategory.category_id')
                            ->where('category.id','=', $category->id)
                            ->select('product.name','product.id', 'product.price', 'product.image','subcategory.category_id')
                            ->limit(5)
                            ->get();
                if($products)
                {
                    $data[$category->name] = $products;
                }            
            }
        }
        
        return response()->json(['product' => $data, 'category' => $categories]);


    }


    public function homepage(Request $request)
    {
        
        $data = array();

        $categories = Category::all(); 

        if($cat_id = $request->input('cat_id')){

            $category = Category::findOrFail($cat_id);
                
            $products = DB::table('product')->join('subcategory','subcategory.id','=','product.subcategory_id')
                        ->join('category', 'category.id','=','subcategory.category_id')
                        ->where('category.id','=', $category->id)
                        ->select('product.name','product.id', 'product.price', 'product.image')
                        ->get();
          
            $data[$category->name] = $products;            
            
            
        } else {

            foreach ($categories as $key => $category) {
                
                $products = DB::table('product')->join('subcategory','subcategory.id','=','product.subcategory_id')
                            ->join('category', 'category.id','=','subcategory.category_id')
                            ->where('category.id','=', $category->id)
                            ->select('product.name','product.id', 'product.price', 'product.image','subcategory.category_id')
                            ->limit(5)
                            ->get();
                if($products)
                {
                    $data[$category->name] = $products;
                }            
            }
        }
        
        return view('homepage', ['products' => $data, 'category' => $categories]);
    }

    public function search(Request $request){

        $key = $request->input('key');
        $products = Product::search($key)->get();
        // $products = DB::table('product')
        //                 ->where('name','like', "%$key%")
        //                 ->get();
    
        // Notification::send(Auth::user(), new NotifExample());
        
        return view('search', ['products'=> $products]);



    }

    public function coba(){
        
        dd(Auth::user()->unreadNotifications);

    }
}
