<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\Api\TradingAccount\{
    TradingAccountController,
    AuthController
};



Route::controller(AuthController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');;
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('profile', 'profile');
        Route::get('logout', 'logout');
    });
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/add/trading_account', [TradingAccountController::class, 'store']);
    Route::post('/change/trading_account/password', [TradingAccountController::class, 'changePassword']);
});
