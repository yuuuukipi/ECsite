<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{

  protected $fillable = [
      'postal_code', 'prefecture', 'detail',
  ];


  public function user() {
    return $this->belongsTo('App\User','address_id');
  }

}
