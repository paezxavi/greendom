<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Company;

class CompanyController extends Controller
{
  public function __construct()
  {
      $this->middleware('guest');
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view('home');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response

     * Modèle de création dans la base de données d'une nouvelle compagnie
     * Pour le moment address et email à null, car la seule page qui crée est "S'inscrire" => A discuter
   */
  public function create(Request $request)
  {
    $newCompany = new Company();
    $newCompany->name = $request->name;
    $newCompany->address = null;
    $newCompany->email = null;
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
    $newCompany->address = null;
    $newCompany->email = null;
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
