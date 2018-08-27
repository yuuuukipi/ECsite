<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    // //マイページ
    // public function mypage(){
    //   $user=Auth::user();
    //   // dd($user);
    //   return view('users.mypage')->with('user', $user);
    // }

    //会員情報
    public function info(){
      $user=Auth::user();
      // dd($user);
      return view('users.info')->with('user', $user);
    }

    //購入履歴
    public function history(){
      $user=Auth::user();
      // dd($user);
      return view('users.history')->with('user', $user);
    }

    //情報更新
    public function update(request $request){
      $birthday=$request->birthday1.'-'.$request->birthday2.'-'.$request->birthday3;
      // dd($request->gender);

      Auth::user()->name=$request->name;
      Auth::user()->email=$request->email;
      Auth::user()->gender=$request->gender;
      Auth::user()->birthday=$birthday;
      Auth::user()->phone=$request->phone;
      Auth::user()->address=$request->address;
      Auth::user()->save();
      return redirect(url('mypage/info'));
    }

}
