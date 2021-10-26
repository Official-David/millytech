<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TradeController;
use App\Http\Controllers\Admin\TradeableController;


Route::get('/', function(){
    return view('admin.index');
})->name('index');

Route::resource('user', UserController::class);

Route::resource('trade', TradeController::class);

Route::resource('tradeables', TradeableController::class);

