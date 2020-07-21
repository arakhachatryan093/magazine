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
Auth::routes([
    'reset' => false,
    'confirm' => false,
    'verify' => false,

]);


Route::group([
    'middleware' => 'auth',
    'prefix' => 'admin'
], function () {

        Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('categories','Admin\CategoryController');

});


Route::group(['prefix' => 'basket'],function () {

    Route::post('/add/{id}','BasketController@basketAdd')->name('basketAdd');

    Route::group([
        'middleware' => ['basket_not_empty'],
    ],function () {
        Route::get('/','BasketController@basket')->name('basket');
        Route::get('/place','BasketController@basketPlace')->name('basket_place');
        Route::post('/basket/remove/{id}','BasketController@basketRemove')->name('basketRemove');
        Route::post('/confirm','BasketController@basketConfirm')->name('basket_confirm');
    });


});


Route::get('/','MainController@index')->name('index');
Route::get('/categories','MainController@categories')->name('categories');
Route::get('/{category}','MainController@category')->name('category');
Route::get('/{category}/{product?}','MainController@product')->name('product');










//Route::get('/home', 'HomeController@index')->name('home');
