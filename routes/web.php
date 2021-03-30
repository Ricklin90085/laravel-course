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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['check.dirty'])->group(function () {
    Route::resource('product', 'ProductController');
});

Route::post('signup', 'AuthController@signup');
Route::post('login', 'AuthController@login');

Route::middleware(['auth:api'])->group(function () {
    Route::get('user', 'AuthController@user');
    Route::get('logout', 'AuthController@logout');
    Route::post('carts/checkout', 'CartController@checkout');
    Route::resource('carts', 'CartController');
    Route::resource('cart-items', 'CartItemController');
});
