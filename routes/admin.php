<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TradeController;
use App\Http\Controllers\Admin\GiftCardController;
use App\Http\Controllers\CurrencyController;

Route::get('/', function(){
    return view('admin.index');
})->name('index');

Route::resource('user', UserController::class);

Route::resource('trade', TradeController::class);

Route::resource('giftcards', GiftCardController::class)->except(['show','destroy']);
Route::get('giftcards/add-currency', [GiftCardController::class,'addCurrency'])->name('giftcards.add');
Route::get('giftcards/{id}/destroy', [GiftCardController::class,'destroy'])->name('giftcards.destroy');

Route::resource('currencies', CurrencyController::class);

