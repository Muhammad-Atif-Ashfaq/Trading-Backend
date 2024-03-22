<?php

use  App\Http\Controllers\Api\TradingAccount\{
    TradingAccountController
};


Route::post('/add/trading_account',             [TradingAccountController::class, 'store'])->name('add.trading_account');
Route::post('/change/trading_account/password', [TradingAccountController::class, 'changePassword'])->name('changePassword.trading_account');