<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'image', 'nom', 'categorie', 'prixVente', 'reference', 'refSupplier', 'prixAchat',
    ];
}
