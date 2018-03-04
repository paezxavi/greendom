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

//Auth::routes();

Route::get('/sessionStatus', function() {
    return ['user' => Auth::user() ? Auth::user() : null];
});

//Auth
//-------------------------------------------------------------
Route::get('/logout', 'Auth\LoginController@logout')->name('logout')->middleware('auth');
Route::get('/login', 'Auth\LoginController@notLogged')->name('login');

Route::post('/login/{user}', 'Auth\LoginController@login');
//-------------------------------------------------------------

//A supprimer plus tard. Sert d'exemple
Route::get('/customers', 'ProductController@clients');
Route::get('/commandes', 'ProductController@commandes');
Route::get('/providers', 'ProductController@providers');

Route::get('/', 'DevisController@index')->name('home');
/* Call PDF */
Route::get('/devis/pdf', 'DevisController@devisPdf')->name('devis.pdf');
Route::get('/fournisseurList/{product}', 'DevisController@fournisseurs');
Route::get('/produitsOffre', 'DevisController@produits');
Route::get('/infoDevis/{commande}', 'DevisController@clientInfoDevis');
Route::get('/devisList/{user}', 'DevisController@clientDevis');
Route::get('/company/{user}', 'DevisController@companieClientDevis');
Route::get('/company/{user}/{commande}', 'DevisController@companieClientDevis');
Route::get('/{user}', 'DevisController@infoClient');
Route::get('/{user}/{commande}', 'DevisController@infoClient');

Route::post('/validerDevis/{commande}', 'DevisController@validerDevis');
Route::post('/storeDevis/{user}/{commande}', 'DevisController@store')->name('storeDevis');
Route::post('/insertNewDevis/{user}', 'DevisController@create')->name('storeDevis');



//Faire un chemin /devis pour pouvoir faire les devis vide et faire des post depuis la!


//Route::get('/offre/pdf', 'OffreController@offrePdf')->name('offre.pdf');
//Route::get('/commande/pdf', 'CommandeController@commandePdf')->name('commande.pdf');

/*Route::any('{all}', function () {
    return view('welcome');
})
->where(['all' => '.*']);*/
