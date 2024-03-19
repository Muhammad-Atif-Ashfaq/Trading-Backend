<?php
use  App\Http\Controllers\Api\Admin\{
    BrandController, 
    TradingAccountGroupController, 
    TradingAccountController
};

Route::middleware('auth:sanctum')->group( function () {

    Route::Resource('/brands',                 BrandController::class);
    Route::Resource('/trading_accounts',       TradingAccountController::class);
    Route::Resource('/trading_account_groups', TradingAccountGroupController::class);
});
?>