<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    \App\Jobs\ProcessPaddingOrder::dispatch(\App\Models\TradeOrder::first());
//    \App\Jobs\ProcessPaddingOrder::dispatch(\App\Models\TradeOrder::first());
//    \App\Jobs\ProcessPaddingOrder::dispatch(\App\Models\TradeOrder::first());
//    \App\Jobs\ProcessPaddingOrder::dispatch(\App\Models\TradeOrder::first());
//    \App\Jobs\ProcessPaddingOrder::dispatch(\App\Models\TradeOrder::first());
//    \App\Jobs\ProcessPaddingOrder::dispatch(\App\Models\TradeOrder::first());
//    \App\Jobs\ProcessPaddingOrder::dispatch(\App\Models\TradeOrder::first());
//    \App\Jobs\ProcessPaddingOrder::dispatch(\App\Models\TradeOrder::first());
//    \App\Jobs\ProcessPaddingOrder::dispatch(\App\Models\TradeOrder::first());
//    \App\Jobs\ProcessPaddingOrder::dispatch(\App\Models\TradeOrder::first());
//    \App\Jobs\ProcessPaddingOrder::dispatch(\App\Models\TradeOrder::first());
    return view('welcome');
});
