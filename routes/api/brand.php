<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Config\ConfigController;
use  App\Http\Controllers\Api\Brand\{
    TransactionOrderController,
    TradingGroupController,
    TradingAccountController,
    TradeOrderController,
    GroupTradeOrderController,
    GroupTransactionOrderController,
    DashboardController,
    BrandCustomerController,
    BrandController,
    SymbelGroupController,
    BrandLoginActivityController,

};



Route::middleware('auth:sanctum')->group(function () {
    Route::get('/getAllBrandCustomerList', [BrandCustomerController::class, 'getAllBrandCustomerList']);
    Route::apiResource('/transaction_order', TransactionOrderController::class);
    Route::apiResource('/group_transaction_orders', GroupTransactionOrderController::class);
    Route::apiResource('/trading_accounts', TradingAccountController::class);
    Route::get('/getAllTradingAccountList', [TradingAccountController::class, 'getAllTradingAccountList']);
    Route::apiResource('/trading_account_groups', TradingGroupController::class);
    Route::get('/getAllTradingGroupList', [TradingGroupController::class, 'getAllTradingGroupList']);
    Route::apiResource('/trade_orders', TradeOrderController::class);
    Route::post('/update_multi_trade_order', [TradeOrderController::class, 'multiUpdate']);
    Route::apiResource('/group_trade_orders', GroupTradeOrderController::class);
    Route::post('/change-password', [BrandController::class, 'changePassword']);
    Route::post('/getDashboardData', [DashboardController::class, 'getDashboardData']);
    Route::get('/getAllSymbelGroupList', [SymbelGroupController::class, 'getAllSymbelGroupList']);
    Route::get('/getConfig', [ConfigController::class, 'getBrandConfig']);
    Route::get('/getLoginActivity', [BrandLoginActivityController::class, 'index']);
});