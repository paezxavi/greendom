<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Company;

class CompanyController extends Controller
{
  /**
   * Retourne la liste des compagnies qui sont dans BDD Company
   */
  public function getCompanies()
  {
    $result = Company::all();
    return $result;
  }

  /**
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   *
   * Retourne la compagnie qui a l'id passé en paramètre
   */
  public function getCompany(Request $request)
  {
    $comp = DB::table('companies')->where('id', $request->id)->first();
    return response()->json($comp);
  }

  /**
   * @param  \Illuminate\Http\Request  $request
   *
   * Modifie la compagnie qui a l'id passé en paramètre avec les informations passées en paramètre
   */
  public function updateCompany(Request $request)
  {
    $update = Company::where('id', $request->id)
      ->update([
        'name' => $request->name,
        'address'=> $request->address,
        'email' => $request->email,
      ]
    );
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   *
   * Modèle de création dans la base de données d'une nouvelle compagnie
   */
  public function create(Request $request)
  {
    $newCompany = new Company();
    $newCompany->name = $request->name;
    $newCompany->address = $request->address;
    $newCompany->email = $request->email;
    $newCompany->save();
  }

  /**
   * Enregistrement dans la BDD d'une nouvelle entrée dans la table Company
   * Retourne l'id de l'entrée créée
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $newCompany = new Company();
    $newCompany->name = $request->name;
    $newCompany->address = $request->address;
    $newCompany->email = $request->email;
    $newCompany->save();
    return $newCompany->id;
  }

  /**
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   *
   * Reçoit un String dans $request->name qui représente le nom d'une companie
   * Recherche dans la BDD Company le nom de la companie "String reçu"
   * Retourne l'id si elle existe sinon retourne null
   *
   */
  public function findId(Request $request)
  {
    $companyId = DB::table('companies')->select('id')->where('name', $request->name)->get();
    return $companyId;
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
      //
  }
}//CompanyController
