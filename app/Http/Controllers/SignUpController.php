<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class SignUpController extends Controller
{
    /**
     * Retourne la liste des clients qui sont dans BDD User avec le nom de la société
     */
    public function getCustomersAndSocName()
    {
      return DB::table('users')
        ->where('employee','=','false')
        ->leftJoin('companies', 'company_id', '=', 'companies.id')
        ->select('users.*', 'companies.name as company')
        ->get();
    }

    /**
     * Retourne la liste des produits avec le nom du fuornisseur lié au produit
     */
    public function getProductsAndProvName(){
        return DB::table('products')
          ->leftJoin('providers_products_pivot', 'products.id', '=', 'product_id')
          ->leftJoin('providers', 'providers.id', '=', 'provider_id')
          ->select('products.*', 'providers.name')
          ->get();
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * Retourne le client qui a l'id passé en paramètre
     */
    public function getCustomer(Request $request)
    {
      $customer = DB::table('users')->where('id', $request->id)->first();
      return response()->json($customer);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     *
     * Modifie le client qui a l'id passé en paramètre avec les informations passées en paramètre
     */
    public function updateCustomer(Request $request)
    {
      $update = User::where('id', $request->id)
        ->update([
          'name' => $request->name,
          'forename' => $request->forename,
          'address'=> $request->address,
          'email' => $request->email,
          'contact' => $request->skype,
          'phone' => $request->phone,
        ]
      );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response

       *création dans la base de données d'un nouvel utilisateur
       *pour le moment l'utilisateur est créé dans la bdd avec employé=>false + compnany_id => null
     */
    public function create(Request $request)
    {
      $newUser = new User();
      $newUser->name = $request->name;
      $newUser->forename = $request->forename;
      $newUser->address = $request->address;
      $newUser->phone = $request->phone;
      $newUser->contact = $request->skype;
      $newUser->email = $request->email;
      $newUser->password = Hash::make($request->pwd);
      $newUser->employee = false;
      $newUser->company_id = $request->companyId;
      $newUser->save();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $newUser = new User();
      $newUser->name = $request->name;
      $newUser->forename = $request->forename;
      $newUser->address = $request->address;
      $newUser->phone = $request->phone;
      $newUser->contact = $request->skype;
      $newUser->email = $request->email;
      $newUser->password = Hash::make($request->pwd);
      $newUser->employee = false;
      $newUser->company_id = $request->companyId;;
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
        //
    }
}//SignUpController
