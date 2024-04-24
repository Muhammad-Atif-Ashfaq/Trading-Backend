<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\Api\Admin\{
    BrandController,
    TransactionOrderController,
    SymbelGroupController,
    TradingGroupController,
    TradingAccountController,
    SymbelSettingController,
    TradeOrderController,
    GroupTradeOrderController,
    DataFeedController,
    TickAndChartController,
    GroupTransactionOrderController
};


Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/brands', BrandController::class);
    Route::get('/getAllBrandList', [BrandController::class, 'getAllBrandList']);

    Route::apiResource('/transaction_order', TransactionOrderController::class);

    Route::apiResource('/group_transaction_orders', GroupTransactionOrderController::class);

    Route::apiResource('/trading_accounts', TradingAccountController::class);
    Route::get('/getAllTradingAccountList', [TradingAccountController::class, 'getAllTradingAccountList']);
    Route::get('/getAllTradingAccountsNotInGroup', [TradingAccountController::class, 'getAllTradingAccountsNotInGroup']);

    Route::apiResource('/trading_account_groups', TradingGroupController::class);
    Route::get('/getAllTradingGroupList', [TradingGroupController::class, 'getAllTradingGroupList']);

    Route::apiResource('/symbel_group', SymbelGroupController::class);
    Route::get('/getAllSymbelGroupList', [SymbelGroupController::class, 'getAllSymbelGroupList']);

    Route::apiResource('/symbel_setting', SymbelSettingController::class);
    Route::get('/getAllSymbelGroupList', [SymbelSettingController::class, 'getAllSymbelGroupList']);

    Route::apiResource('/trade_orders', TradeOrderController::class);

    Route::apiResource('/group_trade_orders', GroupTradeOrderController::class);

    Route::apiResource('/data_feed', DataFeedController::class);
    Route::get('/getAllDataFeedList', [DataFeedController::class, 'getAllDataFeedList']);

    Route::get('/ticks', [TickAndChartController::class, 'ticks']);
    Route::get('/charts', [TickAndChartController::class, 'charts']);
});

