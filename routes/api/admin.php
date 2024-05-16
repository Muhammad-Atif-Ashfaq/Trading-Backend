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
    DashboardController,
    MassActionController,
    PermissionController,
    BrandCustomerController
};


Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/brands', BrandController::class);
    Route::get('/getAllBrandList', [BrandController::class, 'getAllBrandList']);

    Route::get('/getAllBrandCustomerList', [BrandCustomerController::class, 'getAllBrandCustomerList']);

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
    Route::get('/getAllSymbelSettingList', [SymbelSettingController::class, 'getAllSymbelSettingList']);

    Route::apiResource('/trade_orders', TradeOrderController::class);
    Route::post('/update_multi_trade_order', [TradeOrderController::class,'multiUpdate']);

    Route::apiResource('/group_trade_orders', GroupTradeOrderController::class);

    Route::apiResource('/data_feed', DataFeedController::class);
    Route::get('/getAllDataFeedList', [DataFeedController::class, 'getAllDataFeedList']);

    Route::get('/ticks',                          [TickAndChartController::class, 'ticks']);
    Route::get('/charts',                         [TickAndChartController::class, 'charts']);

    Route::post('/change-password',                [AdminController::class, 'changePassword']);
    Route::post('/getDashboardData',            [DashboardController::class, 'getDashboardData']);

    Route::put('/massEdit',            [MassActionController::class, 'massEdit']);
    Route::delete('/massDelete',            [MassActionController::class, 'massDelete']);
    Route::post('/massCloseOrders',            [MassActionController::class, 'massCloseOrders']);

    Route::post('/assign_permission',            [PermissionController::class, 'assign_permission']);
});

