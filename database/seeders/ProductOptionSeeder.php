<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('product_options')->insert([
            'name' => 'Color'
        ]);
        DB::table('product_options')->insert([
            'name' => 'Size'
        ]);
        DB::table('product_options')->insert([
            'name' => 'Type'
        ]);
    }
}
