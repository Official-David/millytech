<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;


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

Route::get('', [PagesController::class, 'home'])->name('home');
Route::get('about-us', [PagesController::class, 'aboutUs'])->name('about-us');
Route::get('business', [PagesController::class, 'business'])->name('business');
Route::get('contact-us', [PagesController::class, 'contactUs'])->name('contact-us');
Route::get('services', [PagesController::class, 'services'])->name('services');

