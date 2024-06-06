<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BillController extends Controller
{

    public function createBill(Request $request)
    {
        try {

            $request->validate([
                'userId' => 'required|integer',
                'productId' => 'required|integer',
                'quantityPurchased' => 'required|integer',
                'DatePurchase' => 'required|date',
                'Purchased' => 'required|string'
            ]);

            $bill = Bill::create($request->all());
            return response()->json(['message' => 'Bill created successfully', 'bill' => $bill], 201);
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return response()->json(['message' => "Failed to create bill: $errorMessage"], 500);
        }
    }

    public function getBillByUser()
    {

        try {
            $user = Auth::user();

            $bills = Bill::where('userId', $user->userId)->with('products')->get();

            return response()->json(['bills' => $bills], 200);
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return response()->json(['message' => "Failed to get bills: $errorMessage"], 500);
        }
    }
    public function getMonthlyRevenue($year)
    {
        try {
            $monthlyRevenue = Bill::select(
                DB::raw('MONTH(DatePurchase) as month'),
                DB::raw('SUM(Purchased) as total_revenue')
            )
                ->whereYear('DatePurchase', $year)
                ->groupBy(DB::raw('MONTH(DatePurchase)'))
                ->get();

            return response()->json(['monthly_revenue' => $monthlyRevenue], 200);
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return response()->json(['message' => "Failed to get monthly revenue: $errorMessage"], 500);
        }
    }

    public function getYearlyRevenue()
    {
        try {
            $yearlyRevenue = Bill::select(
                DB::raw('YEAR(DatePurchase) as year'),
                DB::raw('SUM(Purchased) as total_revenue')
            )
                ->groupBy(DB::raw('YEAR(DatePurchase)'))
                ->get();

            return response()->json(['yearly_revenue' => $yearlyRevenue], 200);
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return response()->json(['message' => "Failed to get yearly revenue: $errorMessage"], 500);
        }
    }
    public function getBills()
    {
        try {
            $products = Bill::all();

            return response()->json($products);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Đã xảy ra lỗi: ' . $e->getMessage()], 500);
        }
    }
    public function getBillsByID($billId)
    {
        try {

            if (!$billId) {
                return response()->json(['message' => 'Thiếu thông tin billId'], 400);
            }

            $bill = Bill::find($billId);

            if ($bill) {
                return response()->json($bill, 200);
            } else {
                return response()->json(['message' => 'Không tìm thấy hóa đơn'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Có lỗi xảy ra: ' . $e->getMessage()], 500);
        }
    }
}
