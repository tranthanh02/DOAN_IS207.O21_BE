<?php

namespace App\Http\Controllers;

use App\Models\ProductStyle;
use Illuminate\Http\Request;


class ProductStyleController extends Controller
{


    public function getProductStyle()
    {
        try {
            $productstyle = ProductStyle::all();

            return response()->json($productstyle);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Đã xảy ra lỗi: ' . $e->getMessage()], 500);
        }
    }
}
