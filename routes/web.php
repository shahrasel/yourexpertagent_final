<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/search', [App\Http\Controllers\HomeController::class, 'search'])->name('search');
Route::post('/signup', [\App\Http\Controllers\UserController::class, 'signup'])->name('signup');
Route::post('/signin', [\App\Http\Controllers\UserController::class, 'signin'])->name('signin');

Route::get('/profile', [\App\Http\Controllers\UserController::class, 'profile'])->name('profile')->middleware('auth');

Route::post('/signout', [\App\Http\Controllers\UserController::class, 'signout'])->name('signout');

Route::any('/compare-properties', [\App\Http\Controllers\PropertyController::class, 'compareProperties'])->name('compare_properties');

Route::get('/property_details/{property:permalink}/residential', [App\Http\Controllers\PropertyController::class, 'property_details'])->name('property_details');
Route::get('/get-gmp-amenities',[\App\Http\Controllers\PropertyController::class,'get_gmap_amenities'])->name('get_gmap_amenities');
Route::get('/add_remove_fav',[\App\Http\Controllers\PropertyController::class,'add_remove_fav'])->name('add_remove_fav');
