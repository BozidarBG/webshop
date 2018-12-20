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

Route::get('/', 'FrontController@welcome')->name('welcome');

Route::get('/category/{slug}', 'FrontController@category')->name('category');

Route::get('/product/{slug}', 'FrontController@product')->name('product');

Route::get('/brand/{slug}', 'FrontController@brand')->name('brand');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();

});
