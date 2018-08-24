<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ms_product extends Model
{
    //
    public function ms_category() {
      return $this->belongsTo('App\Ms_category','category_id');
    }

}
