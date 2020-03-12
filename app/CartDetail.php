<?php

namespace OneStop;

use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    protected $table = 'cart_detail';
    
    protected $fillable = ['cart_id', 'product_id'];
    
    public function cart()
    {
        return $this->belongsTo('OneStop\Cart');
    }

    public function product()
    {
        return $this->belongsTo('Modules\Product\Entities\Product', 'product_id');
    }
}
