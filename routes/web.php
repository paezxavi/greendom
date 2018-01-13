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

Route::get('/company/{user}', 'DevisController@companieClientDevis');
Route::get('/{user}', 'DevisController@clientDevis');
Route::get('/{user}/{commande}', 'DevisController@clientInfoDevis');
/* Call PDF */
Route::get('/devis/pdf', 'DevisController@devisPdf')->name('devis.pdf');
//Route::get('/offre/pdf', 'OffreController@offrePdf')->name('offre.pdf');
//Route::get('/commande/pdf', 'CommandeController@commandePdf')->name('commande.pdf');
