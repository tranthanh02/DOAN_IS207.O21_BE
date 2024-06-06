<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;



class DataUserTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_type')->insert([
            //

            "userTypeId" => 1,
            "userTypeName" => "Người Dùng"
        ]);
        DB::table('user_type')->insert([
            //
            "userTypeId" => 2,
            "userTypeName" => "Admin"
        ]);
    }
}
