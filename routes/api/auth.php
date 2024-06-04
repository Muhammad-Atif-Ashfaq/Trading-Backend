<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\Api\Auth\AuthController;
use  App\Http\Controllers\Api\Auth\UserLoginActivityController;


Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::middleware('auth:sanctum')->group( function () {
        Route::get('logout', 'logout');
    });
});
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/user_login_activities', UserLoginActivityController::class);
});




