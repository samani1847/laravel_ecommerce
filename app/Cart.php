<?php

namespace OneStop;

use Illuminate\Database\Eloquent\Model;
use DB;

class Cart extends Model
{
    protected $table = 'cart';
    
    protected $fillable = ['user_id'];
    
    public function detail()
    {
        return $this->hasMany('OneStop\CartDetail');
    }

    public function getTotal(){
        $totals = DB::table('cart_detail')
                ->join('cart', 'cart_detail.cart_id', '=', 'cart.id')
                ->join('product', 'cart_detail.product_id', '=', 'product.id')
                ->select(
                    DB::raw('count(cart_detail.id) as total_item, SUM(product.price) as total_price')
                )
                ->where('cart.id', $this->id)
                ->get();

        return $totals[0];
    }
}
