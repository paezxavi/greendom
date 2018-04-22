<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
  protected $table = 'commandes';

  public function status() {
    return $this->belongsTo('App\Status');
  }

  public function users() {
    return $this->belongsTo('App\User','user_id');
  }

  public function products() {
    return $this->belongsToMany('App\Product','commandes_products_pivot','commande_id','product_id')->withPivot("quantity","prix","remisePrix","remiseBoolean","remisePourcent","total");
  }

}
