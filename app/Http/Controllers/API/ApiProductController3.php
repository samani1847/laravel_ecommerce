<?php

namespace OneStop\Http\Controllers\API;

use Illuminate\Http\Request;
use Modules\Product\Entities\Product;
use OneStop\Category;
use OneStop\Cart;
use OneStop\Notifications\NotifExample;

use DB, Auth, Shoppingcart, Notification;

class ApiProductController extends Controller
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
        return response()->json(['data' => $product]);
    }
   
}
