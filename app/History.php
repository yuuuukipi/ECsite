<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    //
    public function product() {
      return $this->belongsTo('App\Product','product_id');
    }
    public function user() {
      return $this->belongsTo('App\User','user_id');
    }

}
