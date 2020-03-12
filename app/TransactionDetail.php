<?php

namespace OneStop;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $table = 'transaction_detail';
    
    protected $fillable = ['transaction_id', 'product_id'];
   
    public function transaction()
    {
        return $this->belongsTo('OneStop\Transaction');
    }
   
    public function product()
    {
        return $this->belongsTo('Modules\Product\Entities\Product', 'product_id');
    }
   
  
}
