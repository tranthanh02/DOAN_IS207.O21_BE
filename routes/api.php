<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\ProductStyleController;
use App\Http\Controllers\UserFavoriteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// authentication routes
Route::post('auth/register', [AuthController::class, 'register']);
Route::post('auth/login', [AuthController::class, 'login']);
Route::post('auth/reset-password', [AuthController::class, 'resetPassword'])->middleware('auth:api');
Route::get('auth/user-infor', [AuthController::class, 'getUserInfo'])->middleware('auth:api');
Route::post('auth/google', [AuthController::class, 'loginWithGoogle']);

//favorites routes
Route::post('/user-favorites/add', [UserFavoriteController::class, 'addToFavorites'])->middleware('auth:api');
Route::post('/user-favorites/remove', [UserFavoriteController::class, 'removeFromFavorites'])->middleware('auth:api');
Route::get('/favorites/{userId}', [UserFavoriteController::class, 'getUserFavorites'])->middleware('auth:api');

// user routes
Route::put('user/update-user-info', [UserController::class, 'updateUserInfo'])->middleware('auth:api');
Route::post('user/change-password', [UserController::class, 'changeUserPassword'])->middleware('auth:api');
Route::get('user/get-all-bills', [UserController::class, 'getUserBills'])->middleware('auth:api');
Route::get('users', [UserController::class, 'getUsers']);

// bill routes
Route::post('bill/create-bill', [BillController::class, 'createBill']);
Route::get('bill/get-bill-user', [BillController::class, 'getBillByUser'])->middleware('auth:api');;

//product routes admin
Route::post('/product/add-product', [ProductController::class, 'addProduct']);
Route::put('/product/update-product/{id}', [ProductController::class, 'updateProduct']);
Route::delete('/product/delete-product/{id}', [ProductController::class, 'deleteProduct']);
Route::get('/users/search', [UserController::class, 'searchUsersByName']);
Route::get('/revenue/monthly/{year}', [BillController::class, 'getMonthlyRevenue']);
Route::get('/revenue/yearly', [BillController::class, 'getYearlyRevenue']);
Route::get('/bill', [BillController::class, 'getBills']);
Route::get('/bill/{billId}', [BillController::class, 'getBillsByID']);
Route::put('/user/update-user-info-admin/{id}', [UserController::class, 'updateUserInfoAdmin']);

//product routes
Route::get('/products', [ProductController::class, 'getProducts']);
Route::get('/products/{productId}', [ProductController::class, 'getProductInfo']);
Route::get('/top-products', [ProductController::class, 'getTopProducts']);
Route::get('/search-products', [ProductController::class, 'searchProducts']);
Route::patch('/products/{id}/purchase', [ProductController::class, 'updateProductQuantityAfterPurchase']);

//product_type routes
Route::get('/products-style', [ProductStyleController::class, 'getProductStyle']);
