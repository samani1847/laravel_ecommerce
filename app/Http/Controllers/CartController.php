<?php

namespace OneStop\Http\Controllers;

use Illuminate\Http\Request;
use OneStop\Cart;
use OneStop\CartDetail;

use Validator, Rest, Auth;

class CartController extends Controller
{
    public function index(){

    }

    public function loadData(){
        $id = Auth::user()->id;
        Cart::where('user_id','=',$id)->with('cartDetail.product');

    }

    public function addToCart(Request $request){
      

        if(Auth::guest()){
            return Rest::error("You need to login first");
        } 
        $id = Auth::user()->id;

        $cart = Cart::where('user_id', '=', $id)->first();

        if(!$cart){
            $cart = Cart::create(['user_id' =>$id]);            
        }

        $product_id = $request->input('product_id');

        $cartDetail = CartDetail::where('cart_id','=',$cart->id)->where('product_id','=',$product_id)->first();
        
        if(!$cartDetail){
            $data = [
                'cart_id' => $cart->id,
                'product_id' => $request->input('product_id')
            ];
    
            CartDetail::create($data);    
        }
      
        $cart = Cart::where('user_id','=', $id)->with('detail')->first();
        // var_dump($cart->detail);
        return Rest::success("Successfully add to cart", ['total'=>count($cart->detail)]);
        
    }

    public function loadCartView(Request $request){
        $cart = new class{};
        if(Auth::guest() ==false){
            $cart = Cart::where('user_id','=', Auth::id())->with('detail.product')->first();
            if($cart){
                $cart->total = $cart->getTotal();
            }        
        }
        
        return view('cartview', ['cart' => $cart]);
    }

    //delete cart detail
    public function delete(Request $request, $id){
           
        try{
            $cartDetail = CartDetail::findOrFail($id);
            $cartDetail->delete();
   
            return Rest::success('Cart is deleted successfully' );

        } catch(Exception $e){
           
            return Rest::error('Error deleting data');

        }
    }

    public function checkout(Request $request){
        $cart = [];
        if(!Auth::guest()){
            $cart = Cart::where('user_id','=', Auth::id())->with('detail.product')->first();
            if(count($cart->detail)){
                $cart->total = $cart->getTotal();
                return view('checkout', ['cart' => $cart]);
            } 
            
        }
        return redirect('/')->with('status', 'Cart is empty');
       
    }
}
