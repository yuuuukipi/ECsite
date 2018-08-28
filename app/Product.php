<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    public function category() {
      return $this->belongsTo('App\Category','category_id');
    }

    public function carts() {
      return $this->hasmany('App\Cart','product_id');
    }

}
