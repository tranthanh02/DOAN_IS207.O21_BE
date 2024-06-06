<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserFavorite;

class UserFavoriteController extends Controller
{
    public function addToFavorites(Request $request)
    {
        $validatedData = $request->validate([
            'userId' => 'required|exists:users,userId',
            'productId' => 'required|exists:products,productId'
        ]);

        // Kiểm tra xem sản phẩm đã được thêm vào danh sách yêu thích của người dùng trước đó hay không
        $existingFavorite = UserFavorite::where('userId', $validatedData['userId'])
            ->where('productId', $validatedData['productId'])
            ->first();

        if ($existingFavorite) {
            // Nếu đã tồn tại, trả về thông báo
            return response()->json(['message' => 'Sản phẩm đã có trong danh sách yêu thích của bạn!'], 200);
        }

        // Nếu chưa tồn tại, tạo bản ghi mới trong bảng UserFavorite
        $userFavorite = UserFavorite::create($validatedData);

        return response()->json(['message' => 'Đã thêm sản phẩm vào danh sách yêu thích của bạn!', 'data' => $userFavorite], 201);
    }
    public function removeFromFavorites(Request $request)
    {
        $validatedData = $request->validate([
            'userId' => 'required|exists:users,userId',
            'productId' => 'required|exists:products,productId'
        ]);

        $userFavorite = UserFavorite::where('userId', $validatedData['userId'])
            ->where('productId', $validatedData['productId'])
            ->first();

        if ($userFavorite) {
            $userFavorite->delete();
            return response()->json(['message' => 'Sản phẩm đã được xóa khỏi danh sách yêu thích thành công'], 200);
        } else {
            return response()->json(['message' => 'Không tìm thấy sản phẩm trong danh sách yêu thích'], 404);
        }
    }
    public function getUserFavorites($userId)
    {
        // Lấy tất cả các sản phẩm yêu thích của người dùng
        $userFavorites = UserFavorite::with('product')
            ->where('userId', $userId)
            ->get();


        if ($userFavorites->isEmpty()) {
            return response()->json(['message' => 'Không tìm thấy mục yêu thích nào cho người dùng này'], 404);
        }

        return response()->json(['message' => 'Get User favorites retrieved successfully', 'data' => $userFavorites], 200);
    }
}
