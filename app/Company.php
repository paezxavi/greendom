<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
  public function Customers()
  {
      return $this->hasMany('App\Customers');
  }
}
