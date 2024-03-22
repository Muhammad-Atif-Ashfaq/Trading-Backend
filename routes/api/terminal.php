<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Terminal\LoginController;
use App\Http\Controllers\Api\Terminal\OrderController;


Route::post('/login',           [LoginController::class,'login']);

Route::middleware('auth:sanctum')->group( function () {
    Route::apiResource('/orders',OrderController::class);
});
