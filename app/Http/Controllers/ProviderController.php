<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Provider;

class ProviderController extends Controller
{
  /**
   * Retourne la liste des fournisseurs qui sont dans BDD Provider
   */
  public function getProviders()
  {
    $result = Provider::all();
    return $result;
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response

   * Création dans la base de données d'un nouveauuuuu fournisseur
   */
  public function create(Request $request)
  {
    $newProv = new Provider();
    $newProv->name = $request->name;
    $newProv->address = $request->address;
    $newProv->email = $request->email;
    $newProv->skype = $request->skype;
    $newProv->iban = $request->iban;
    $newProv->save();
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $newProv = new Provider();
    $newProv->name = $request->name;
    $newProv->address = $request->address;
    $newProv->email = $request->email;
    $newProv->skype = $request->skype;
    $newProv->iban = $request->iban;
    $newUser->save();
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
      //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $console.log("je vais deleted");
    $console.log($id);
  }
}
