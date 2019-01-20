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

Route::post('/price-range', 'FrontController@range')->name('range');



Route::post('/search', 'FrontController@search')->name('search');

Auth::routes();
Route::post('/login', [
    'uses'=>'Auth\LoginController@authenticate',
    'as'=>'login'
]);

Route::group(['middleware'=>'auth'], function(){
    Route::get('/checkout', 'CartController@index')->name('checkout');
    Route::post('/checkout', 'CartController@store')->name('checkout.store');
    Route::get('/checkout-check', 'CartController@check')->name('checkout.check');
    Route::get('/products-by-ajax', 'CartController@productsByAjax');

    Route::get('/profile', 'ProfileController@show')->name('profile.show');
    Route::get('/address', 'AddressController@create')->name('address.create');
    Route::post('/address', 'AddressController@store')->name('address.store');
    Route::get('/address/{address}/edit', 'AddressController@edit')->name('address.edit');
    Route::post('/address-update/{address}', 'AddressController@update')->name('address.update');
    Route::post('/address/{address}/delete', 'AddressController@destroy')->name('address.destroy');
});




Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();

});


