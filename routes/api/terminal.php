<?php

use App\Http\Controllers\Api\Terminal\LoginController;
use App\Http\Controllers\Api\Terminal\OrderController;
use App\Http\Controllers\Api\Terminal\SymbelController;
use App\Http\Controllers\Api\Terminal\TradingAccountLoginActivityController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [LoginController::class, 'login']);
Route::post('/is_valid_brand/{brand_domain}/{brand_public_key}', [LoginController::class, 'isValidBrand']);
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/orders', OrderController::class);
    Route::post('/update_multi_trade_order', [OrderController::class, 'multiUpdate']);

    Route::get('/symbels', [SymbelController::class, 'index']);

    Route::apiResource('/trading_account_login_activities', TradingAccountLoginActivityController::class);

});
