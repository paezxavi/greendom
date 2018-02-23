<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Customer;
use App\User;
use App\Commande;
use App\Company;
use Carbon\Carbon;

class DevisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('welcome');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      dd("hello");
      $customerDevis = new Commande();
      $customerDevis->dateDebut = Carbon::now();
      $customerDevis->concerne = "";
      $customerDevis->num_devis = Carbon::now()->format('Y-m-d');
      $customerDevis->num_offre = Carbon::now()->format('Y-m-d');
      $customerDevis->num_commande = Carbon::now()->format('Y-m-d');
      $customerDevis->user_id = 1; //A changer dans le futur avec le AuthId()
      $customerDevis->descriptionDevis = "";
      $customerDevis->status_id = 1;
      $customerDevis->save();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      /*$commandes = $request->commande['id'];
      return $commandes;
      foreach($commandes as $commande){
          echo $commande;
      }
      return $commande;*/
      if (empty($request->commande['id'])){
        $customerDevis = new Commande();
        $customerDevis->dateDebut = Carbon::now();
        $customerDevis->concerne = $request->commande['concerne'];
        $customerDevis->num_devis = Carbon::now()->format('Y-m-d')."_D";
        $customerDevis->num_offre = Carbon::now()->format('Y-m-d')."_O";
        $customerDevis->num_commande = Carbon::now()->format('Y-m-d')."_C";
        $customerDevis->user_id = 1; //A changer dans le futur avec le AuthId()
        $customerDevis->descriptionDevis = $request->commande['descriptionDevis'];
        $customerDevis->status_id = 1;
        $customerDevis->save();
      } else {
        $customerDevis = Commande::find($request->commande['id'])->where([
                            ['user_id',$request->customer['id']],
                            ['id',$request->commande['id']]
                            ])->get()->first();
        $customerDevis->concerne = $request->commande['concerne'];
        $customerDevis->descriptionDevis = $request->commande['descriptionDevis'];
      }
      $customerDevis->save();
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
        $pdf = PDF::loadView('pdf/devis_pdf', compact('user'))->setPaper('a3', 'portrait');
        $name = "Client-".$customer->name.".pdf";
        return $pdf->download($name);
    }

    public function infoClient(User $user)
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
      /*$customerDevisCr = new Commande();
      $customerDevisCr->dateDebut = Carbon::now();
      $customerDevisCr->concerne = "";
      $customerDevisCr->num_devis = Carbon::now()->format('Y-m-d');
      $customerDevisCr->num_offre = Carbon::now()->format('Y-m-d');
      $customerDevisCr->num_commande = Carbon::now()->format('Y-m-d');
      $customerDevisCr->user_id = 1; //A changer dans le futur avec le AuthId()
      $customerDevisCr->descriptionDevis = "";
      $customerDevisCr->status_id = 1;
      $customerDevisCr->save();*/
      return $customerDevis;
    }

    public function companieClientDevis(User $user){
        $companie = Company::find($user->company_id);
        return $companie;
    }

    public function clientDevis(User $user)
    {
      if($user->employee == true){
        $devis = Commande::with('status')
                    ->get()
                    ->sortBy('commandes.dateDebut');
      } else {
        $devis = Commande::with('status','users')
                    ->where('user_id', $user->id)
                    //->join('status', 'status.id', '=', 'commandes.status_id')
                    //->join('users','users.id', '=', 'commandes.user_id')
                    //->select('commandes.*','status.nom','users.employee')
                    ->get();
      }
      return $devis;
    }

}
