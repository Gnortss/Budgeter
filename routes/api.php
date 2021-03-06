<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\SpecialOfferController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\SavedOfferController;
use App\Http\Controllers\AuthController;

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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::resource('offers', SpecialOfferController::class);


Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::resource('categories', CategoryController::class)->except(['create','edit']);
    Route::resource('coupons', CouponController::class);
    Route::resource('transactions', TransactionController::class)->except(['update']);
    Route::resource('saved', SavedOfferController::class)->except(['update']);
    Route::post('/logout', [AuthController::class, 'logout']);
});