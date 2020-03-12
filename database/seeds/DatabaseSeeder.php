<?php

use Illuminate\Database\Seeder;

use Modules\Product\Database\Seeders\ProductDatabaseSeeder;
use Modules\Voucher\Database\Seeders\VoucherDatabaseSeeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(ProductDatabaseSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(PaymentMethodSeeder::class);
        $this->call(VoucherDatabaseSeeder::class);
    }
}
