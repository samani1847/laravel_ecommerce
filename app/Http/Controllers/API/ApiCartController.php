<?php

namespace OneStop\Http\Controllers\API;

use Illuminate\Http\Request;
use OneStop\Http\Controllers\Controller;
use Validator, Rest, Auth;
use OneStop\Cart;
use OneStop\CartDetail;


class ApiCartController extends Controller
{
    public function addToCart(Request $request){
        $id = 2;//Auth::user()->id;
        $validator = Validator::make($request->all(), ['product_id'=> 'required|integer']);

        if($validator->fails()){
            return Rest::error('Error parameter');
        }
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
        
        $cart = Cart::where('user_id','=', $id)->with('detail');
        $cartTotal = $cart->count;
        // var_dump($cart->detail);
        return Rest::success("Successfully add to cart", ['total'=>count($cart->detail)]);
        
    }

    public function coba
}
