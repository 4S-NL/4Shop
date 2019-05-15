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


Route::group(['middleware' => 'shopopen'], function () {
    Route::get('/', 'ProductController@set')->name('home');
    Route::view('/gesloten', 'closed')->name('closed');

    Route::get('/leden', 'ProductController@set')->name('leden');
    Route::get('/leiding', 'ProductController@set')->name('leiding');
    Route::get('/winkel', 'ProductController@index')->name('shop');

    Route::get('/winkel/mandje', 'OrderController@cart')->name('cart');
    Route::get('/winkel/mandje/verwijder/{key}', 'OrderController@remove')->name('cart.remove');
    Route::get('/winkel/bestellen', 'OrderController@order')->name('order');
    Route::post('/winkel/bestellen', 'OrderController@pay')->name('pay');
    Route::get('/winkel/{product}', 'ProductController@show')->name('products.show');
    Route::post('/winkel/{product}', 'ProductController@order')->name('products.order');

    Route::get('/bestelling/{order}/{slug}', 'OrderController@show')->name('order.show');
    Route::get('/bestelling/{order}/{slug}/cancel', 'OrderController@cancel')->name('order.cancel');

    Route::get('/ideal/pay/{order}', 'IdealController@redirect')->name('ideal.pay');
	Route::get('/ideal/finish/{order}', 'IdealController@finish')->name('ideal.finish');
    Route::get('/ideal/webhook/{order}', 'IdealController@webhook');

});
