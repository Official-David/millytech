<?php

use App\Http\Controllers\Admin\NotificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TradeController;
use App\Http\Controllers\Admin\GiftCardController;
use App\Http\Controllers\Admin\SystemController;
use App\Models\GiftCard;

Route::get('/', [DashboardController::class, 'dashboard'])->name('index');

Route::resource('user', UserController::class);
Route::get('user/{id}/alert', [UserController::class, 'showAlertModal'])->name('user.alert');
Route::post('user/{id}/alert', [UserController::class, 'addAlert']);
Route::delete('user/{id}/alert', [UserController::class, 'clearAlert']);



Route::resource('trade', TradeController::class)->except(['show']);
Route::get('trade/change-status/{id}', [TradeController::class, 'showStatus'])->name('trade.change-status-modal');
Route::post('trade/change-status/{id}', [TradeController::class, 'changeStatus'])->name('trade.change-status');
Route::get('trade/show/{id}', [TradeController::class, 'show']);
Route::get('trade/pay-form/{id}', [TradeController::class, 'payForm']);
Route::post('trade/pay/{id}', [TradeController::class, 'pay'])->name('trade.pay');

Route::resource('notifications', NotificationController::class)->only('store', 'create');


Route::resource('giftcards', GiftCardController::class)->except(['show', 'destroy']);
Route::post('giftcards/check-name', [GiftCardController::class, 'checkName'])->name('giftcards.check-name');
Route::get('giftcards/add-currency', [GiftCardController::class, 'addCurrency'])->name('giftcards.add');
Route::get('giftcards/{id}/destroy', [GiftCardController::class, 'destroy'])->name('giftcards.destroy');

Route::prefix('settings')->name('settings.')->group(function () {
    Route::resource('admin', AdminController::class)->middleware('can:super-admin');
    Route::get('password', [AdminController::class, 'password'])->name('password');
    Route::post('password', [AdminController::class, 'changePassword'])->name('password.change');
    Route::post('deactivate-trading', [SystemController::class, 'deactivateTrading'])->name('deactivate-trading');
});
