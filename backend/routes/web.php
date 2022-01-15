<?php

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

Route::get('products', 'ProductController@index');
Route::get('carts', 'CartController@index');
Route::resource('ajax/products', 'Ajax\ProductController')
    ->only(['index']);
Route::resource('ajax/carts', 'Ajax\CartController')
    ->only(['index', 'store', 'update', 'destroy']);
