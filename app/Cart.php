<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //
    protected $fillable = [
        'user_id', 'product_id', 'amount','comp_flg',
    ];

    public function product() {
      return $this->belongsTo('App\Product','product_id');
    }

    public function user() {
      return $this->belongsTo('App\User','user_id');
    }


}
