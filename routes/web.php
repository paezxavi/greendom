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

Route::get('/sessionStatus', function() {
    return ['user' => Auth::user() ? Auth::user() : null];
});

//Auth
Route::get('/logout', 'Auth\LoginController@logout')->name('logout')->middleware('auth');
Route::get('/login', 'Auth\LoginController@notLogged')->name('login');

Route::post('/login/{user}', 'Auth\LoginController@login');
//-------------------------------------------------------------

//SignUpController
Route::get('/customersList', 'SignUpController@getCustomersAndSocName');
Route::get('/customer', 'SignUpController@getCustomer');
Route::post('/createUser', 'SignUpController@store');
Route::put('/customer', 'SignUpController@updateCustomer');
//-------------------------------------------------------------

//CompanyController
Route::get('/findCompanyId', 'CompanyController@findId');
Route::get('/companiesList', 'CompanyController@getCompanies');
Route::get('/company', 'CompanyController@getCompany');
Route::post('/createCompany', 'CompanyController@store');
Route::put('/company', 'CompanyController@updateCompany');
//-------------------------------------------------------------

//ProviderController
Route::get('/providersList', 'ProviderController@getProviders');
Route::get('/provider', 'ProviderController@getProvider');
Route::post('/provider', 'ProviderController@store');
Route::put('/provider', 'ProviderController@updateProvider');
//-------------------------------------------------------------

//ProductController
Route::get('/productList', 'ProductController@products');
Route::get('/productListWithProvName', 'ProductController@getProductsAndProvName');
Route::get('/product', 'ProductController@getProduct');
Route::put('/product', 'ProductController@updateProduct');
//----------------------------------------------------------------------------------

Route::get('/', 'CommandeController@index')->name('home');

/* Call PDF */
Route::get('/files/{commande}', 'FileController@index');
Route::get('/downloadFile/{file}', 'FileController@download');
Route::get('/demandeList', 'CommandeController@demandeList');
Route::get('/offreList', 'CommandeController@offreList');
Route::get('/commandeList', 'CommandeController@commandeList');
Route::get('/produitsCommande/{commande}','CommandeController@produitsEnregistres');
Route::get('/offre/pdf', 'CommandeController@devisPdf')->name('devis.pdf');
Route::get('/fournisseurList/{product}', 'CommandeController@fournisseurs');
Route::get('/produitsOffre', 'CommandeController@produits');
Route::get('/infoCommande/{commande}', 'CommandeController@clientInfoDevis');
Route::get('/commandeList/{user}', 'CommandeController@clientDevis');
Route::get('/company/{user}', 'CommandeController@companieClientDevis');
Route::get('/company/{user}/{commande}', 'CommandeController@companieClientDevis');
Route::get('/{user}', 'CommandeController@infoClient');
Route::get('/{user}/{commande}', 'CommandeController@infoClient');

//post panier email
Route::post('/mailCommandeRecue/{user}/{commande}','CommandeController@mailCommandeRecue');
Route::post('/mailCommande/{commande}','CommandeController@mailCommande');
Route::post('/emailPanier/{user}', 'CommandeController@emailPanier');
Route::post('/validerStatut/{commande}', 'CommandeController@validerStatut');
Route::post('/validerClient/{commande}', 'CommandeController@validerClient');
Route::post('/storeDemande/{user}/{commande}', 'CommandeController@store')->name('storeDevis');
Route::post('/updateDemande/{user}/{commande}', 'CommandeController@updateCommande')->name('storeDevis');
Route::post('/insertDemande/{user}', 'CommandeController@create')->name('storeDevis');
Route::post('/updateUser/{user}', 'CommandeController@updateUser');

Route::post('/fournisseurMailDemandePrix/{commande}','CommandeController@mailFournisseurDemandePrix');
Route::post('/clientMailOffre/{user}/{commande}','CommandeController@mailClientOffre');

Route::put('/abandonner/{commande}','CommandeController@abandonnerCommande');

Route::delete('/supprimerProduit/{produit}/{commande}', 'CommandeController@supprimerProduit');
Route::delete('/removeFile/{file}', 'FileController@remove');

Route::post('/storeFile/{commande}','FileController@storeFile');
