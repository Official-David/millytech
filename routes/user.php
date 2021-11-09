<?php

use App\Http\Controllers\User\TradeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\SettingsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::view('', 'user.index')->name('index');

Route::prefix('trades')->as('trades.')->group(function(){
    Route::get('',[TradeController::class,'index'])->name('index');
    Route::post('place',[TradeController::class,'place'])->name('place');
    Route::get('currencies/{id}',[TradeController::class,'currencies'])->name('currencies');
    Route::get('rate/{id}',[TradeController::class,'rate'])->name('rate');

    Route::get('history',[TradeController::class,'history'])->name('history');
    Route::get('history/show/{id}',[TradeController::class,'show'])->name('show');
});

Route::prefix('settings')->as('settings.')->group(function(){
    Route::get('bank',[SettingsController::class, 'bankDetails'])->name('bank.details');
    Route::post('bank',[SettingsController::class, 'bankDetailsUpdate'])->name('bank.details.update');

});

