<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
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
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   *
   * Retourne le fournisseur qui a l'id passé en paramètre
   */
  public function getProvider(Request $request)
  {
    $provider = DB::table('providers')->where('id', $request->id)->first();
    return response()->json($provider);
  }

  /**
   * @param  \Illuminate\Http\Request  $request
   *
   * Modifie le fournisseur qui a l'id passé en paramètre avec les informations passées en paramètre
   */
  public function updateProvider(Request $request)
  {
    $update = Provider::where('id', $request->id)
      ->update([
        'nom' => $request->name,
        'adresse'=> $request->address,
        'phone' => $request->phone,
        'skype' => $request->skype,
        'email' => $request->email,
        'iban' => $request->iban,
      ]
    );
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
    $newProv->nom = $request->name;
    $newProv->adresse = $request->address;
    $newProv->email = $request->email;
    $newProv->phone = $request->phone;
    $newProv->skype = $request->skype;
    $newProv->iban = $request->iban;
    $newProv->save();
  }

  /**
   * Enregistrement dans la BDD d'une nouvelle entrée dans la table Provider
   * Retourne l'id de l'entrée créée.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $newProv = new Provider();
    $newProv->nom = $request->name;
    $newProv->adresse = $request->address;
    $newProv->email = $request->email;
    $newProv->phone = $request->phone;
    $newProv->skype = $request->skype;
    $newProv->iban = $request->iban;
    $newProv->save();
    return $newProv->id;
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
}
