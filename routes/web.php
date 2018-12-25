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

Route::get('/about', 'FrontController@about')->name('about');

Route::get('/contact', 'FrontController@contact')->name('contact');

Route::post('/contact', 'FrontController@contactUs')->name('contactUs');

Route::post('/sort-products-by-price-range', 'FrontController@sortBy')->name('sortBy');



Auth::routes();
Route::post('/login', [
    'uses'=>'Auth\LoginController@authenticate',
    'as'=>'login'
]);

Route::group(['middleware'=>'auth'], function(){
    Route::get('/cart', 'CartController@index')->name('cart');
});




Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();

});
