<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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




Route::middleware('auth')->group(function(){
    Route::middleware('can:viewBackend')->group(function(){
        Route::resource('admin/users','UserController');

        Route::post('admin/changePhoto', 'BookController@changePhoto');
        Route::resource('admin/category','CategoryController');
    });
    Route::resource('admin/books','BookController');
    Route::middleware('can:viewFrontend')->group(function(){
        Route::resource('admin/orders','OrderController');

        Route::get('/', 'FrontEndController@index');
        Route::get('cart', 'FrontEndController@cart');
        Route::get('add-to-cart/{id}', 'FrontEndController@addToCart');
        Route::get('delete-from-cart/{id}', 'FrontEndController@deleteFromCart');

        Route::get('/checkout','OrderController@form_submit_front')->middleware(['auth']);
        Route::get('/submit_checkout','OrderController@submit_front')->name('submitcheckout')->middleware(['auth']);

        Route::get('member/orders/{order}', 'OrderController@show')->name('member.orders.show');
    });

    Route::get('/home', 'HomeController@index')->name('home');
});
Auth::routes();



