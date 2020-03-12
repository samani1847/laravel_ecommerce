<?php
namespace OneStop\CustomClass;

use Illuminate\Http\Response;
use Auth,DB;
use OneStop\Cart;
use OneStop\CartDetail;

class Shoppingcart
{

    public static function token()
    {
        return csrf_token();
    }

    public static function total_item()
    {
        $cart_total = 0;

        if(!Auth::guest()){
            $cart = Cart::where('user_id', '=', Auth::user()->id)->with('detail')->first();
            
            $cart_total = ($cart)?count($cart->detail):0;    
        }
        return $cart_total;
        

    }

    public static function isEmpty()
    {
        if(!Auth::guest()){

            $cart = DB::table('cart_detail')
                            ->select(
                                DB::raw('count(id) as total')
                            )
                            ->where('user_id', Auth::id())
                            ->first();
            
            if($cart->total > 0){
                return 1;
            }    
        }
        
        return 0;
    }

}
