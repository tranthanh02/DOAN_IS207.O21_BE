<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;



class DataProductStyleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_style')->insert([
            //

            "styleId" => 1,
            "styleName" => "Nike"
        ]);
        DB::table('product_style')->insert([
            //

            "styleId" => 2,
            "styleName" => "Adidas"
        ]);
        DB::table('product_style')->insert([
            //

            "styleId" => 3,
            "styleName" => "Puma"
        ]);
    }
}
