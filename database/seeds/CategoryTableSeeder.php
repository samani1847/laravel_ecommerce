<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("category")->insert([
            'name' => 'Movies',
            'status' => true
            ]);
            //id 1
        DB::table("subcategory")->insert([
            'name' => 'Action',
            'status' => true,
            'category_id' => 1
            ]);
            //id 2
        DB::table("subcategory")->insert([
                'name' => 'Animation',
                'status' => true,
                'category_id' => 1
                ]);
            //id3
        DB::table("subcategory")->insert([
            'name' => 'Horror',
            'status' => true,
            'category_id' => 1
            ]);


        
        DB::table("category")->insert([
            'name' => 'Music',
            'status' => true
            ]);

            //id 4
        DB::table("subcategory")->insert([
            'name' => 'Rock',
            'status' => true,
            'category_id' => 2
            ]);
            //id 5
        DB::table("subcategory")->insert([
            'name' => 'Jazz',
            'status' => true,
            'category_id' => 2
            ]);


        DB::table("category")->insert([
                    'name' => 'Books',
                    'status' => true
                    ]);
            //id 6
        DB::table("subcategory")->insert([
            'name' => 'Fiction',
            'status' => true,
            'category_id' => 1
            ]);
                                                
        DB::table("category")->insert([
                        'name' => 'Application',
                        'status' => true
                        ]);
    }
}
