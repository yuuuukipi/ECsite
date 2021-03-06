<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','gender','birthday','address','phone',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function carts() {
      return $this->hasmany('App\Cart','user_id');
    }

    public function histories() {
      return $this->hasmany('App\Histories','user_id');
    }

    public function address() {
      return $this->belongsTo('App\Address','address_id');
    }


}
