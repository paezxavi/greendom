<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Mail;
use App\Customer;
use App\User;
use App\Provider;
use App\Commande;
use App\Company;
use App\Product;
use Carbon\Carbon;
use App\Mail\DevisEnvoye;
use App\Mail\FournisseurMail;
use Illuminate\Auth\AuthenticationException;

class CommandeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }
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
    public function create(Request $request)
    {
      if ($request->typeSubmit === 'Enregistrer'){
        $this->insertNewDevis($request, 0);
      } elseif ($request->typeSubmit === 'Envoyer') {
        $this->insertNewDevis($request, 1);
        $user = User::where('employee', true)->get();
        Mail::to($user)->send(new DevisEnvoye($request));
      }

    }

    public function insertNewDevis(Request $request, $typeSubmit)
    {
      $customerDevis = new Commande();
      $customerDevis->dateDebut = Carbon::now();
      $customerDevis->concerne = $request->commande['concerne'];
      $customerDevis->num_demande = Carbon::now()->format('Y-m-d')."_D";
      $customerDevis->num_offre = Carbon::now()->format('Y-m-d')."_O";
      $customerDevis->num_commande = Carbon::now()->format('Y-m-d')."_C";
      $customerDevis->user_id = $request->customer['id'];
      $customerDevis->descriptionCommande = $request->commande['descriptionCommande'];
      $customerDevis->status_id = 1 + $typeSubmit;
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
      if ($request->typeSubmit === 'Enregistrer'){
        $this->enregistrerCommande($request, 0);
      } elseif ($request->typeSubmit === 'Envoyer') {
        $this->enregistrerCommande($request, 1);
        $user = User::where('employee', true)->get();
        Mail::to($user)->send(new DevisEnvoye($request));
      }

    }

    public function enregistrerCommande(Request $request, $typeSubmit){
      $customerDevis = Commande::find($request->commande['id'])->where([
                          ['id',$request->commande['id']]
                          ])->get()->first();
      $customerDevis->concerne = $request->commande['concerne'];
      $customerDevis->descriptionCommande = $request->commande['descriptionCommande'];
      $customerDevis->status_id = $request->commande['status_id'] + $typeSubmit;
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

    public function infoClient(User $user, Commande $commande)
    {
      if (!Commande::find($commande->id)){
        $customer = User::find($user->id);
      } else {
        $clientCommande = Commande::find($commande->id)->where('id', $commande->id)->get()->first();
        $customer = User::where("id", $clientCommande->user_id)->get()->first();
      }

      return $customer;
    }

    public function clientInfoDevis(Commande $commande)
    {
      $customerDevis = Commande::find($commande->id)->where('id', $commande->id)->get()->first();
      return $customerDevis;
    }

    public function companieClientDevis(User $user, Commande $commande){
        if (!Commande::find($commande->id)){
          $companie = Company::find($user->company_id);
        } else {
          $clientCommande = Commande::find($commande->id)->where('id', $commande->id)->get()->first();
          $customer = User::where("id", $clientCommande->user_id)->get()->first();
          $companie = Company::find($customer->company_id);
        }
        return $companie;
    }

    public function clientDevis(User $user)
    {
      if($user->employee == true){
        $devis = Commande::with('status','users')
                    //->join('users','users.id', '=', 'commandes.user_id')
                    //->select('commandes.*','users.*')
                    ->get()
                    ->sortBy('commandes.dateDebut');
      } else {
        $devis = Commande::with('status','users')
                    ->where('user_id', $user->id)
                    //->join('status', 'status.id', '=', 'commandes.status_id')
                    //->join('users','users.id', '=', 'commandes.user_id')
                    //->select('commandes.*','status.nom','users.employee')
                    ->get();
        //Essaie de merge deux query.
        /*$curUser = User::where('id',$user->id)->first();

        $merged = $curUser->toBase()->merge($devis);
        return $merged;*/
        /*$currendUser = User::with('devis')
                          ->get();
        return $currendUser;*/
      }
      return $devis;
    }

    public function produits()
    {
      $result = Product::all();
      return $result;
    }

    public function fournisseurs(Product $product)
    {
      $four = Product::find($product->id);
      return $four->providers()->get();
    }

    public function validerStatut(Commande $commande)
    {
      $com = Commande::find($commande->id)->where('id', $commande->id)->get()->first();
      $com->status_id = $com->status_id+1;
      $com->save();
      return $com;
    }

    public function mailFournisseurDemandePrix()
    {
      //Faudra fournir la liste de fournisseur a contacter + produits de la commande et fournisseur
      $customer = User::findOrFail(1);
      $pdf = PDF::loadView('pdf/devis_pdf', compact('user'))
                  ->setPaper('a3', 'portrait');
      $path = storage_path('/app/public/Test.pdf');
      $pdf->save($path);
      $user = User::where('employee',true)->get();
      Mail::to($user)->send(new FournisseurMail('Hello test'));
      return 'mail envoyé depuis le controleur';
    }

}
