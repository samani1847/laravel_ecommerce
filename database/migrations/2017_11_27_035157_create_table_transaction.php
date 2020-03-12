<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
        Schema::create('transaction', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('paypal_code')->nullable();
            $table->integer('payment_method')->unsigned();
            $table->double('subtotal');
            $table->string('status');
            $table->string('voucher_code')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('payment_method')->references('id')->on('payment_method');
            $table->timestamps();
        });

        Schema::create('transaction_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('transaction_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->foreign('transaction_id')->references('id')->on('transaction');
            $table->foreign('product_id')->references('id')->on('product');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_detail');
        Schema::dropIfExists('transaction');
    }
}
