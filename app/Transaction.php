<?php

namespace OneStop;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transaction';
    
    protected $fillable = ['user_id', 'paypal_code', 'status', 'subtotal', 'payment_method', 'voucher_code'];

    public function detail()
    {
        return $this->hasMany('OneStop\TransactionDetail');
    }
    
}
