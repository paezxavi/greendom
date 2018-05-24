<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Mail;
use Auth;
use App\Customer;
use App\User;
use App\Provider;
use App\Commande;
use App\Company;
use App\Product;
use Carbon\Carbon;
use App\Mail\DemandeEnvoye;
use App\Mail\FournisseurMail;
use App\Mail\PanierMail;
use App\Mail\ClientOffreMail;
use App\Mail\CommandeRecueMail;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Hash;

class CommandeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index','produits']);
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
      $idReturn;
      if ($request->typeSubmit === 'Enregistrer'){
        $newCommande = $this->insertNewDevis($request, 0);
      } elseif ($request->typeSubmit === 'Envoyer') {
        $newCommande = $this->insertNewDevis($request, 1);
        $user = User::where('employee', true)->get();
        Mail::to($user)->send(new DemandeEnvoye($newCommande));
      }
      return $newCommande->id;
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
      return $customerDevis;
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
        $comm = Commande::where('id',$request->commande)->get()->first();
        Mail::to($user)->send(new DemandeEnvoye($comm));
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
      if($request->products) {
        foreach($request->products as $product){
          $customerDevis->products()->attach(1 , ([
                                                    'commande_id' => $request->commande['id'],
                                                    'product_id' => $product['id'],
                                                    'quantity' => $product['quantite'],
                                                    'prix' => $product['prix'],
                                                    'remiseBoolean' => $product['remiseBoolean'],
                                                    'remisePrix' => $product['remisePrix'],
                                                    'remisePourcent' => $product['remisePourcent'],
                                                    'total' => $product['total'],
                                                    'fournisseur' => $product['fournisseurChoisi'],
                                                    'description' => $product['description']
                                                  ]));
          echo "insert";
        }
      }
    }

    public function updateCommande(Request $request, $typeSubmit){
      $customerDevis = Commande::find($request->commande['id'])->where([
                          ['id',$request->commande['id']]
                          ])->get()->first();
      foreach($request->products as $product) {
          $customerDevis->products()->updateExistingPivot($product['id'] , ([
                                                    'commande_id' => $request->commande['id'],
                                                    'product_id' => $product['id'],
                                                    'quantity' => $product['quantite'],
                                                    'prix' => $product['prix'],
                                                    'remiseBoolean' => $product['remiseBoolean'],
                                                    'remisePrix' => $product['remisePrix'],
                                                    'remisePourcent' => $product['remisePourcent'],
                                                    'total' => $product['total']
                                                  ]));
          echo "update";
      }
      
    }
    

    public function produitsEnregistres(Commande $commande) {
      $commandeProduits = Commande::find($commande->id)->where('id',$commande->id)->get()->first();
      return $commandeProduits->products()->get();
    }

    public function supprimerProduit(Product $produit, Commande $commande) {
      $getCommandeId = Commande::find($commande->id)->where('id',$commande->id)->get()->first();
      $idCommande = $getCommandeId->id;

      $getProduitId = Product::find($produit->id)->where('id',$produit->id)->get()->first();
      $idProduit = $getProduitId->id;

      $x = $getCommandeId->products()->wherePivot('product_id', $idProduit)->detach(); //le produit
      //dd($x);
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
        $customer = Auth::user();
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

    public function validerClient(Commande $commande)
    {
      $com = Commande::find($commande->id)->where('id', $commande->id)->get()->first();
      if($com->status_id == 4){
        $com->status_id = $com->status_id+1;
      }else if($com->status_id == 3){
        $com->status_id = $com->status_id+2;
      }

      $com->save();
      return $com;
    }

    public function demandeList()
    {
      $list = Commande::with('status','users')
                    ->where('status_id', 1)
                    ->orWhere('status_id', 2)
                    ->get()
                    ->sortBy('commandes.dateDebut');
      return $list;
    }

    public function offreList()
    {
      $list = Commande::with('status','users')
                    ->where('status_id', 3)
                    ->get()
                    ->sortBy('commandes.dateDebut');
      return $list;

    }

    public function commandeList()
    {
      $list = Commande::with('status','users')
                    ->where('status_id', 4)
                    ->orWhere('status_id', 5)
                    ->get()
                    ->sortBy('commandes.dateDebut');
      return $list;
    }

    public function mailFournisseurDemandePrix(Commande $commande)
    {
      //Faudra fournir la liste de fournisseur a contacter + produits de la commande et fournisseur
      $products = Commande::find($commande->id)->products()->get();
      $users = User::where('employee',true)->get();
      $demandePrix = 'Demande de prix';
      $produitsFournisseurs;
      //dd($products);
      foreach($products as $produit) {
        //dd($produit->pivot->quantity);
        $var = $produit->pivot->quantity;
        $arr = $produit->getAttributes();
        $arr[] = ['quantity' => $var];
        $produitsFournisseurs[$produit->pivot->fournisseur][] = $arr;
      }
      //dd($produitsFournisseurs);
      foreach($produitsFournisseurs as $keyFourn => $valueFourn) {
        //dd($valueFourn);
        $prov = Provider::where('nom',$keyFourn)->get()->first();
        $arrProd = [];
        $arrProd[] = $valueFourn;
        /*foreach($valueFourn as $prod) {
          echo $prod['description'];
          
        }*/
        //dd($arrProd[0]);
        $arrPr = $arrProd[0];
        $pdf = PDF::loadView('pdf/offre_demande_prix', compact('arrPr', 'prov', 'demandePrix'))
                    ->setPaper('a3', 'portrait');
        $path = storage_path('/app/public/pdf/Test.pdf');
        $pdf->save($path);
        Mail::to($prov)->send(new FournisseurMail('Demande de prix'));
      }
      return 'mail envoyé depuis le controleur';
    }

    public function mailClientOffre(Commande $commande)
    {      
      $products = Commande::find($commande->id)->products()->get();
      $customer = User::findOrFail(1);
      $pdf = PDF::loadView('pdf/offre_client_pdf', array('products' => $products, 'customer' => $customer))
                  ->setPaper('a3', 'portrait');
      $path = storage_path('/app/public/pdf/Test.pdf');
      $pdf->save($path);
      $users = User::where('employee',true)->get();
      Mail::to($users)->send(new ClientOffreMail('Offre'));
      return 'mail envoyé depuis le controleur';
    }

    public function emailPanier(Request $request)
    {
      $users = User::where('employee',true)->get();
      $productsArray = $request->all()["panier"];
      $userConnected = User::find($request->all()["user"]["id"]);
      $panierArray = [];
      foreach($productsArray as $products){
        array_push($panierArray, $products);
      }
      $pdf = PDF::loadView('pdf/achat_catalogue_pdf', array('productArray' => $panierArray,'user' => $userConnected))
                  ->setPaper('a3', 'portrait');
      $path = storage_path('/app/public/pdf/Test.pdf');
      $pdf->save($path);

      $userConnected = User::find($request->all()["user"]["id"]);
      Mail::to($users)->send(new PanierMail($userConnected));
      
    }

    public function mailCommande(Commande $commande)
    {
      $products = Commande::find($commande->id)->products()->get();
      $users = User::where('employee',true)->get();
      $bonCommande = 'Bon de commande';
      $produitsFournisseurs;
      //dd($products);
      foreach($products as $produit) {
        //dd($produit->pivot->quantity);
        $var = $produit->pivot->quantity;
        $arr = $produit->getAttributes();
        $arr[] = ['quantity' => $var];
        $produitsFournisseurs[$produit->pivot->fournisseur][] = $arr;
      }
      //dd($produitsFournisseurs);
      foreach($produitsFournisseurs as $keyFourn => $valueFourn) {
        //dd($valueFourn);
        $prov = Provider::where('nom',$keyFourn)->get()->first();
        $arrProd = [];
        $arrProd[] = $valueFourn;
        /*foreach($valueFourn as $prod) {
          echo $prod['description'];
          
        }*/
        //dd($arrProd[0]);
        $arrPr = $arrProd[0];
        $pdf = PDF::loadView('pdf/offre_demande_prix', compact('arrPr', 'prov', 'bonCommande'))
                    ->setPaper('a3', 'portrait');
        $path = storage_path('/app/public/pdf/Test.pdf');
        $pdf->save($path);
        Mail::to($prov)->send(new FournisseurMail('Bon de commande'));
      }
      return 'mail envoyé depuis le controleur';
    }

    public function mailCommandeRecue(User $user, Commande $commande)
    {
      Mail::to($user)->send(new CommandeRecueMail('Commande Reçue'));
      return 'mail envoyé depuis le controleur';
    }

    public function updateUser(Request $request, User $user) {
      if(trim($request->password) != ""){
        $test = User::where('id', $user->id)
          ->update([
            'name' => $request->username,
            'forename' => $request->forename,
            'address'=> $request->address,
            'phone' => $request->phone,
            'contact' => $request->contact,
            'email' => $request->email,
            'password' => Hash::make($request->password)
          ]
        ); 
      } else {
        $test = User::where('id', $user->id)
          ->update([
            'name' => $request->username,
            'forename' => $request->forename,
            'address'=> $request->address,
            'phone' => $request->phone,
            'contact' => $request->contact,
            'email' => $request->email,
          ]
        );
      }
      
    }

}
