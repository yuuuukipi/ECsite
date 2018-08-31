<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Address;
use App\History;


class UsersController extends Controller
{
    //会員情報
    public function info(){
      $user=Auth::user();
      // dd($user);
      return view('users.info')->with('user', $user);
    }

    //購入履歴
    public function history(){
      $user=Auth::user();
      $histories = History::select('*')
          ->where('user_id','=',Auth::user()->id)
          ->get();

      $his_groups = History::select('order_id')
          ->where('user_id','=',Auth::user()->id)
          ->groupBy('order_id')
          ->get();
          // dd($histories);
          // dd($his_groups[0]->order_id);

      // dd($user);
      return view('users.history')->with(['user'=>$user, 'histories'=>$histories, 'his_groups'=>$his_groups]);
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
      // Auth::user()->address=$request->address;
      Auth::user()->save();

      $address = Address::select('*')
            ->where('id','=',Auth::user()->address_id)->get();
            // dd($address[0]->detail);
      $address[0]->postal_code = $request->postal_code;
      $address[0]->prefecture = $request->prefecture;
      $address[0]->detail = $request->detail;
      $address[0]->save();

      return redirect(url('mypage/info'));
    }

}
