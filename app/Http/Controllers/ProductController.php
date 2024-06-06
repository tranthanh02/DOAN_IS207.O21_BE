<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Product;




class ProductController extends Controller
{
    public function getProducts()
    {
        try {
            $products = Product::all();

            return response()->json($products);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Đã xảy ra lỗi: ' . $e->getMessage()], 500);
        }
    }

    public function addProduct(Request $request)
    {
        try {
            $request->validate([
                'productName' => 'required|string',
                'productPrice' => 'required|numeric',
                'styleId' => 'integer',
                'productImage' => 'string',
                'productStatus' => 'boolean',
                'productQuantity' => 'integer',
                'productSoldQt' => 'integer',
                'productInfor' => 'string',
                'productIntro' => 'string',
                'productDiscount' => 'numeric',
                'productTmName' => 'string'
            ]);

            $product = new Product([
                'productName' => $request->input('productName'),
                'productPrice' => $request->input('productPrice'),
                'styleId' => $request->input('styleId'),
                'productImage' => $request->input('productImage'),
                'productStatus' => $request->input('productStatus'),
                'productQuantity' => $request->input('productQuantity'),
                'productSoldQt' => $request->input('productSoldQt'),
                'productInfor' => $request->input('productInfor'),
                'productIntro' => $request->input('productIntro'),
                'productDiscount' => $request->input('productDiscount'),
                'productTmName' => $request->input('productTmName')
            ]);

            $product->save();

            return response()->json(['message' => 'Sản phẩm đã được thêm thành công'], 201);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Lỗi cơ sở dữ liệu: ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Lỗi: ' . $e->getMessage()], 500);
        }
    }

    public function updateProduct(Request $request, $id)
    {
        try {
            $product = Product::find($id);

            if (!$product) {
                return response()->json(['message' => 'Sản phẩm không tồn tại'], 404);
            }

            $validator = Validator::make($request->all(), [
                'productName' => 'string',
                'productPrice' => 'numeric',
                'styleId' => 'integer',
                'productImage' => 'string',
                'productStatus' => 'boolean',
                'productQuantity' => 'integer',
                'productSoldQt' => 'integer',
                'productInfor' => 'string',
                'productIntro' => 'string',
                'productDiscount' => 'numeric',
                'productTmName' => 'string'
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }

            $product->update($request->all());

            return response()->json(['message' => 'Sản phẩm đã được cập nhật'], 200);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Lỗi cơ sở dữ liệu: ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Lỗi: ' . $e->getMessage()], 500);
        }
    }

    public function deleteProduct(Request $request, $id)
    {
        try {
            $product = Product::find($id);

            if (!$product) {
                return response()->json(['message' => 'Sản phẩm không tồn tại'], 404);
            }

            $product->delete();

            return response()->json(['message' => 'Xóa sản phẩm thành công'], 200);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Lỗi cơ sở dữ liệu: ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Lỗi: ' . $e->getMessage()], 500);
        }
    }


    public function getProductInfo($productId)
    {
        try {

            if (!$productId) {
                return response()->json(['message' => 'Thiếu thông tin productId'], 400);
            }

            $product = Product::find($productId);

            if ($product) {
                return response()->json($product, 200);
            } else {
                return response()->json(['message' => 'Không tìm thấy sản phẩm'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Có lỗi xảy ra: ' . $e->getMessage()], 500);
        }
    }



    public function getProductsByStyle($styleId)
    {
        try {
            if (!$styleId) {
                return response()->json(['message' => 'Thiếu thông tin styleId trong đường dẫn'], 400);
            }

            $products = Product::where('styleId', $styleId)->get();

            if ($products->isNotEmpty()) {
                return response()->json($products, 200);
            } else {
                return response()->json(['message' => 'Không tìm thấy sản phẩm có id này'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Có lỗi xảy ra: ' . $e->getMessage()], 500);
        }
    }

    public function getTopProducts()
    {
        $topProducts = Product::orderBy('productSoldQt', 'desc')
            ->take(10)
            ->get();

        return response()->json($topProducts);
    }
    public function searchProducts(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'minPrice' => 'numeric|nullable',
                'maxPrice' => 'numeric|nullable',
                'styleId' => 'integer|nullable',
                'sortOrder' => 'in:asc,desc|nullable',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }

            $query = Product::query();

            if ($request->has('minPrice')) {
                $query->where('productPrice', '>=', $request->input('minPrice'));
            }

            if ($request->has('maxPrice')) {
                $query->where('productPrice', '<=', $request->input('maxPrice'));
            }

            if ($request->has('styleId')) {
                $query->where('styleId', $request->input('styleId'));
            }

            if ($request->has('sortOrder')) {
                $query->orderBy('productPrice', $request->input('sortOrder'));
            }

            $products = $query->get();

            return response()->json($products, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Có lỗi xảy ra: ' . $e->getMessage()], 500);
        }
    }
    public function updateProductQuantityAfterPurchase(Request $request, $id)
    {
        try {
            $product = Product::find($id);

            if (!$product) {
                return response()->json(['message' => 'Sản phẩm không tồn tại'], 404);
            }

            $validator = Validator::make($request->all(), [
                'quantityPurchased' => 'required|integer|min:1'
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }

            $quantityPurchased = $request->input('quantityPurchased');

            if ($product->productQuantity < $quantityPurchased) {
                return response()->json(['message' => 'Số lượng sản phẩm không đủ'], 400);
            }

            // Update product quantity
            $product->productQuantity -= $quantityPurchased;
            $product->productSoldQt += $quantityPurchased;
            $product->save();

            return response()->json(['message' => 'Cập nhật số lượng sản phẩm thành công', 'remainingQuantity' => $product->productQuantity], 200);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Lỗi cơ sở dữ liệu: ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Lỗi: ' . $e->getMessage()], 500);
        }
    }
}
