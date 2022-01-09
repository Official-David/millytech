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

Route::view('', 'front.index')->name('home');
Route::view('business', 'front.business')->name('business');
Route::view('contact-us', 'front.contact-us')->name('contact-us');
Route::view('services', 'front.services')->name('services');
