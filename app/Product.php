<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    public $timestamps = false;

    protected $fillable = [
        'image', 'nom', 'categorie', 'prixVente', 'reference', 'refSupplier', 'prixAchat',
    ];

    public function customers()
    {
        return $this->belongsToMany('App\User','customers_products_pivot','product_id','user_id')->withPivot('quantity');
    }

    public function providers()
    {
        return $this->belongsToMany('App\Provider','providers_products_pivot','product_id','provider_id');
    }

    public function commandes() {
        return $this->belongsToMany('App\Commandes','commandes_products_pivot','product_id','commande_id');
    }
}
