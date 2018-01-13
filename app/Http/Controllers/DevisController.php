<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Customer;
use App\User;
use App\Commande;
use App\Company;


class DevisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function devisPdf()
    {
        $customer = User::findOrFail(1);
        $pdf = PDF::loadView('pdf/devis_pdf', compact('customer'))->setPaper('a3', 'portrait');
        $name = "Customer-".$customer->nom.".pdf";
        return $pdf->download($name);
    }

    public function clientDevis(User $user)
    {
      $customer = User::find($user->id);
      return $customer;
    }

    public function clientInfoDevis(User $user, Commande $commande)
    {
      $customerDevis = Commande::find($commande->id)->where([
          ['user_id',$user->id],
          ['id',$commande->id]
          ])->get()->first();
      return $customerDevis;
    }

    public function companieClientDevis(User $user){
        $companie = Company::find($user->company_id);
        return $companie;
    }
}