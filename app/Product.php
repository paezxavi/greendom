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
}
