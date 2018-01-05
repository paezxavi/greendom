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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', 'ProductController@products');
Route::get('/customers', 'ProductController@clients');
Route::get('/commandes', 'ProductController@commandes');
Route::get('/providers', 'ProductController@providers');

/* Call PDF */
Route::get('/devis/pdf', 'DevisController@devisPdf')->name('devis.pdf');
