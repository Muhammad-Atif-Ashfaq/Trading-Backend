<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Terminal\{
    LoginController,
    OrderController,
    SymbelController,
    TradingAccountLoginActivityController
};


Route::post('/login',           [LoginController::class,'login']);
Route::middleware('auth:sanctum')->group( function () {
    Route::apiResource('/orders',OrderController::class);
    Route::post('/update_multi_trade_order', [OrderController::class,'multiUpdate']);

    Route::get('/symbels',      [SymbelController::class,'index']);

    Route::apiResource('/trading_account_login_activities', TradingAccountLoginActivityController::class);
});
