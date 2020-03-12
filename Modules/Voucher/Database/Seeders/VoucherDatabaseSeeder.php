<?php

namespace Modules\Voucher\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB;

class VoucherDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        DB::table("voucher")->insert([
            'name' => 'Harbolnas Voucher',
            'discount' => 20,
            'max_claim' => 100,
            'claimed' => 0,
            'status' => true,
            'start_date'=> '2017-11-01',
            'end_date' => '2017-11-30',
            'code' => 'ABC123'
            ]);
        // $this->call("OthersTableSeeder");
    }
}
