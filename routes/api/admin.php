<?php
use  App\Http\Controllers\Api\Admin\BrandController;
use  App\Http\Controllers\Api\Admin\TradingAccountGroupController;
use  App\Http\Controllers\Api\Admin\TradingAccountController;


Route::middleware('auth:sanctum')->group( function () {
    Route::apiResource('/brands',                 BrandController::class);
    Route::apiResource('/trading_accounts',       TradingAccountController::class);
    Route::apiResource('/trading_account_groups', TradingAccountGroupController::class);
});
?>
