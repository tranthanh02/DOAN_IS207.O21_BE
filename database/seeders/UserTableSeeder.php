<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;



class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            //
            "userName" => "Trần Ngọc Thành",
            "userAvt" => "",
            "userPhoneNumber" => "048598595",
            "userAddress" => "Thủ Đức ,Thành phố Hồ Chí Minh",
            "userEmail" => "thanhcuanam02@gmail.com",
            "userPassword" =>  Hash::make("1"),
            "userTypeId" => 1
        ]);
        DB::table('users')->insert([
            //
            "userName" => "Kiệt",
            "userAvt" => "",
            "userPhoneNumber" => "056056850",
            "userAddress" => "Bình Thạnh ,Thành phố Hồ Chí Minh",
            "userEmail" => "kiet@gmail.com",
            "userPassword" =>  Hash::make("1"),
            "userTypeId" => 1
        ]);
        DB::table('users')->insert([
            //
            "userName" => "Tú Vũ",
            "userAvt" => "",
            "userPhoneNumber" => "048598595",
            "userAddress" => "Thủ Đức ,Thành phố Hồ Chí Minh",
            "userEmail" => "tuVu@gmail.com",
            "userPassword" =>  Hash::make("1"),
            "userTypeId" => 1
        ]);
        DB::table('users')->insert([
            //
            "userName" => "Tuyên",
            "userAvt" => "",
            "userPhoneNumber" => "056056850",
            "userAddress" => "Bình Thạnh ,Thành phố Hồ Chí Minh",
            "userEmail" => "Tuyen@gmail.com",
            "userPassword" =>  Hash::make("1"),
            "userTypeId" => 2
        ]);
        DB::table('users')->insert([
            //
            "userName" => "Dung",
            "userAvt" => "",
            "userPhoneNumber" => "056056850",
            "userAddress" => "Bình Thạnh ,Thành phố Hồ Chí Minh",
            "userEmail" => "Dung@gmail.com",
            "userPassword" =>  Hash::make("1"),
            "userTypeId" => 2
        ]);
    }
}
