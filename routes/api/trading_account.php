<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\Api\TradingAccount\{
    TradingAccountController,
    AuthController,
    TransactionOrderController
};



Route::controller(AuthController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');;
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('profile', 'profile');
        Route::get('logout', 'logout');
        Route::post('changePassword', 'changePassword');
    });
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/trading_accounts', TradingAccountController::class);
    Route::get('/getAllTradingAccountList', [TradingAccountController::class, 'getAllTradingAccountList']);

    Route::post('/change/trading_account/password', [TradingAccountController::class, 'changePassword']);
    Route::apiResource('/transaction_order', TransactionOrderController::class);
});