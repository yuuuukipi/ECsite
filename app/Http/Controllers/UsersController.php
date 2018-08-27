<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    //マイページ
    public function mypage(User $user){
      return view('users.mypage')->with('user', $user);
    }

}
