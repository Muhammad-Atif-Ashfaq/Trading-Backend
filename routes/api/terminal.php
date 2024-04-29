<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Terminal\{
    LoginController,
    OrderController,
    SymbelController
};


Route::post('/login',           [LoginController::class,'login']);
Route::middleware('auth:sanctum')->group( function () {
    Route::apiResource('/orders',OrderController::class);
    Route::get('/symbels',      [SymbelController::class,'index']);
});
