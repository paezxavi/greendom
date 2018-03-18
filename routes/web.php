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
Route::get('/logout', 'Auth\LoginController@logout')->name('logout')->middleware('auth');
Route::get('/login', 'Auth\LoginController@notLogged')->name('login');

Route::post('/login/{user}', 'Auth\LoginController@login');
//-------------------------------------------------------------

//SignUpController
Route::post('/saveUser', 'SignUpController@store');
//-------------------------------------------------------------

//A supprimer plus tard. Sert d'exemple
Route::get('/customers', 'ProductController@clients');
Route::get('/commandes', 'ProductController@commandes');
Route::get('/providers', 'ProductController@providers');

Route::get('/', 'CommandeController@index')->name('home');
/* Call PDF */
Route::get('/offre/pdf', 'CommandeController@devisPdf')->name('devis.pdf');
Route::get('/fournisseurList/{product}', 'CommandeController@fournisseurs');
Route::get('/produitsOffre', 'CommandeController@produits');
Route::get('/infoCommande/{commande}', 'CommandeController@clientInfoDevis');
Route::get('/commandeList/{user}', 'CommandeController@clientDevis');
Route::get('/company/{user}', 'CommandeController@companieClientDevis');
Route::get('/company/{user}/{commande}', 'CommandeController@companieClientDevis');
Route::get('/{user}', 'CommandeController@infoClient');
Route::get('/{user}/{commande}', 'CommandeController@infoClient');

Route::post('/validerStatut/{commande}', 'CommandeController@validerStatut');
Route::post('/storeDemande/{user}/{commande}', 'CommandeController@store')->name('storeDevis');
Route::post('/insertDemande/{user}', 'CommandeController@create')->name('storeDevis');

Route::post('/fournisseurMailDemandePrix','CommandeController@mailFournisseurDemandePrix');



//Faire un chemin /devis pour pouvoir faire les devis vide et faire des post depuis la!


//Route::get('/offre/pdf', 'OffreController@offrePdf')->name('offre.pdf');
//Route::get('/commande/pdf', 'CommandeController@commandePdf')->name('commande.pdf');

/*Route::any('{all}', function () {
    return view('welcome');
})
->where(['all' => '.*']);*/
