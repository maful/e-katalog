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

Route::get('/', 'WelcomeController@index');

Auth::routes(['register' => false, 'reset' => false, 'verify' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/suppliers/get-json', 'SupplierController@jsonSuppliers');
    Route::resource('suppliers', 'SupplierController')->except(['show']);

    Route::get('/products/get-json', 'ProductController@jsonProducts');
    Route::resource('products', 'ProductController')->except(['show']);

    Route::get('profile', 'ProfileController@index');
    Route::get('profile/edit', 'ProfileController@edit');
    Route::patch('profile/{user}', 'ProfileController@update');
});
