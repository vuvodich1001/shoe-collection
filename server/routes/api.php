<?php

use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ShoeController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\SocialController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth:api')->group(function () {
    Route::get('address/customer/{id}', [AddressController::class, 'getAddressByCustomerId']);
    Route::get('orders/customer/{id}', [OrderController::class, 'getOrderByCustomerId']);
    Route::apiResource('orders', OrderController::class);
    Route::apiResource('reviews', ReviewController::class);
});

Route::get('reviews/shoe/{id}', [ReviewController::class, 'getReviewsByShoeId']);

Route::get('orders/order-detail/{id}', [OrderController::class, 'getOrderDetailByOrderId']);
Route::apiResource('users', UserController::class);
Route::apiResource('shoes', ShoeController::class);
Route::apiResource('brands', BrandController::class);

Route::get('shoes/related-shoe/{id}', [ShoeController::class, 'getRelatedShoes']);

// auth api
Route::group(['middleware' => ['web']], function () {
    Route::get('google/redirect', [SocialController::class, 'redirect']);
    Route::get('google/callback', [SocialController::class, 'callback']);
});

Route::get('home', function () {
    return 'successfully!';
});
