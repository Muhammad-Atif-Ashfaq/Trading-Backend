<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\Api\Terminal\{
    TradingAccountController
};


Route::post('/add/trading_account', [TradingAccountController::class, 'store'])->name('add.trading_account');
