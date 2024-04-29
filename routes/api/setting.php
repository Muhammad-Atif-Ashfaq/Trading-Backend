<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Setting\SettingController;


Route::middleware('auth:sanctum')->group( function () {
    Route::get('/getSettings',       [SettingController::class,'getSettings']);
    Route::post('/setSettings',       [SettingController::class,'setSettings']);
});

