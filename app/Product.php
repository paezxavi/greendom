<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'image', 'nom', 'categorie', 'prixVente', 'reference', 'refSupplier', 'prixAchat',
    ];

    public function customers()
    {
        return $this->belongsToMany('App\Customer','customers_products_pivot','product_id','customer_id')->withPivot('quantity');
    }
}
