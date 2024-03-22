<?php

use  App\Http\Controllers\Api\Admin\{
        BrandController,
        TransactionOrderController,
        SymbelGroupController,
        TradingGroupController,
        TradingAccountController,
        SymbelSettingController,
        TradeOrderController,
        DataFeedController,
        TickAndChartController
    };




Route::middleware('auth:sanctum')->group( function () {
    Route::apiResource('/brands',                 BrandController::class);
    Route::apiResource('/transaction_order',      TransactionOrderController::class);
    Route::apiResource('/trading_accounts',       TradingAccountController::class);
    Route::apiResource('/trading_account_groups', TradingGroupController::class);
    Route::apiResource('/symbel_group',           SymbelGroupController::class);
    Route::apiResource('/symbel_setting',         SymbelSettingController::class);
    Route::apiResource('/trade_orders',           TradeOrderController::class);
    Route::apiResource('/data_feed',              DataFeedController::class);

    Route::get('/ticks',                          [TickAndChartController::class, 'ticks']);
    Route::get('/charts',                         [TickAndChartController::class, 'charts']);
});

