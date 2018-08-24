<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ms_category extends Model
{
    //
    public function ms_products() {
      return $this->hasMany('App\Ms_product');
    }

}
