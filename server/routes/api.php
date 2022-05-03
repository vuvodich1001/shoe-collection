<?php

use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\ShoeController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\OrderController;
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
    // admin
    Route::post('/admin/login', [AuthController::class, 'adminLogin']);
    Route::post('/admin/register', [AuthController::class, 'adminRegister']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
    Route::post('/change-pass', [AuthController::class, 'changePassWord']);
    // customer
    Route::post('/login', [AuthController::class, 'customerLogin']);
    Route::post('/register', [AuthController::class, 'customerRegister']);
});

Route::middleware('auth:api')->group(function () {
    Route::get('address/customer/{id}', [AddressController::class, 'getAddressByCustomerId']);
    Route::apiResource('orders', OrderController::class);
});

Route::apiResource('users', UserController::class);
Route::apiResource('shoes', ShoeController::class);
Route::apiResource('brands', BrandController::class);

Route::get('shoes/related-shoe/{id}', [ShoeController::class, 'getRelatedShoes']);
