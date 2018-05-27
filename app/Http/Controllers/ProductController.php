<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Customer;
use App\Commande;
use App\Provider;
use App\Greendom;
use App\User;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


    }

    public function clients()
    {
      return User::all();
    }

    public function providers()
    {
      return Provider::all();
    }

    public function commandes()
    {
      return Commande::all();
    }

    public function greendom()
    {
      return Greendom::all();
    }

    public function products()
    {
        /*$file = database_path('seeds/test.csv');

        $customerArr = $this->csvToArray($file);

        for ($i = 0; $i < count($customerArr); $i ++)
        {
            Product::firstOrCreate($customerArr[$i]);
        }*/

        return Product::all();
    }

    /**
     * Retourne la liste des produits avec le nom du fuornisseur lié au produit
     */
    public function getProductsAndProvName(){
        return DB::table('products')
          ->leftJoin('providers_products_pivot', 'products.id', '=', 'product_id')
          ->leftJoin('providers', 'providers.id', '=', 'provider_id')
          ->select('products.*', 'providers.nom')
          ->get();
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * Retourne le produit qui a l'id passé en paramètre
     */
    public function getProduct(Request $request)
    {
      $product = DB::table('products')->where('id', $request->id)->first();
      return response()->json($product);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     *
     * Modifie le produit qui a l'id passé en paramètre avec les informations passées en paramètre
     */
    public function updateProduct(Request $request)
    {
      $update = Product::where('id', $request->id)
        ->update([
          'nom' => $request->name,
          'categorie'=> $request->categorie,
          'reference' => $request->reference,
          'refSupplier' => $request->refSupplier,
          'prixAchat' => $request->prixAchat,
          'prixVente' => $request->prixVente,
        ]
      );
    }

    function csvToArray($filename = '', $delimiter = ';')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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

    public function listeProduits() {

    }


}
