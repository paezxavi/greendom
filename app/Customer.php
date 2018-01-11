<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
  public function products()
  {
      return $this->belongsToMany('App\Product','customers_products_pivot','customer_id','product_id')->withPivot('quantity');
  }
}
