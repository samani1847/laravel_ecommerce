<?php

use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("payment_method")->insert([
            'name' => 'Paypal Payment',
            'status' => true
            ]);
            //id 1
        DB::table("payment_method")->insert([
            'name' => 'Balance Payment',
            'status' => true
            ]);
    }
}
