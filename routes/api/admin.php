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
        GroupTransactionOrderController,
        AdminController,
        DashboardController
    };




Route::middleware('auth:sanctum')->group( function () {
    Route::apiResource('/brands',                 BrandController::class);

    Route::apiResource('/transaction_order',      TransactionOrderController::class);

    Route::apiResource('/group_transaction_orders',GroupTransactionOrderController::class);

    Route::apiResource('/trading_accounts',       TradingAccountController::class);
    Route::get('/getAllTradingAccountsNotInGroup',       [TradingAccountController::class,'getAllTradingAccountsNotInGroup']);

    Route::apiResource('/trading_account_groups', TradingGroupController::class);

    Route::apiResource('/symbel_group',           SymbelGroupController::class);

    Route::apiResource('/symbel_setting',         SymbelSettingController::class);

    Route::apiResource('/trade_orders',           TradeOrderController::class);

    Route::apiResource('/group_trade_orders',     GroupTradeOrderController::class);

    Route::apiResource('/data_feed',              DataFeedController::class);

    Route::get('/ticks',                          [TickAndChartController::class, 'ticks']);
    Route::get('/charts',                         [TickAndChartController::class, 'charts']);

    Route::post('/change-password',                [AdminController::class, 'changePassword']);
    Route::post('/tradingOrderNumbers',            [DashboardController::class, 'tradingOrderNumbers']);
});

