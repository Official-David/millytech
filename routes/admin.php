<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TradeController;
use App\Http\Controllers\Admin\GiftCardController;

Route::get('/', [DashboardController::class, 'dashboard'])->name('index');

Route::resource('user', UserController::class);

Route::resource('trade', TradeController::class)->except(['show']);
Route::post('trade/change-status/{id}',[TradeController::class, 'changeStatus'])->name('trade.change-status');
Route::get('trade/show/{id}',[TradeController::class,'show']);
Route::get('trade/pay-form/{id}',[TradeController::class,'payForm']);
Route::post('trade/pay/{id}',[TradeController::class, 'pay'])->name('trade.pay');

Route::resource('giftcards', GiftCardController::class)->except(['show','destroy']);
Route::get('giftcards/add-currency', [GiftCardController::class,'addCurrency'])->name('giftcards.add');
Route::get('giftcards/{id}/destroy', [GiftCardController::class,'destroy'])->name('giftcards.destroy');

Route::prefix('settings')->name('settings.')->group(function(){
    Route::resource('admin', AdminController::class)->middleware('can:super-admin');
    Route::get('password',[AdminController::class, 'password'])->name('password');
    Route::post('password',[AdminController::class, 'changePassword'])->name('password.change');
});
