<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Config\ConfigController;




Route::middleware('auth:sanctum')->group( function () {

    Route::get('/getConfigDataFeeds',       [ConfigController::class,'getConfigDataFeeds']);

});

