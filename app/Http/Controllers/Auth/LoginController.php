<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Cart;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    //ログイン完了
    public function signin(request $request){
      // dd($request->password);
      if(Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])){

        //カートに商品が入っている場合
        // dd($request->session()->get('member_id'));
        if($request->session()->get('member_id')!=null){
          $carts = Cart::select('*')
                    ->where('user_flg','=','0')
                    ->where('comp_flg','=','0')
                    ->where('member_id','=',$request->session()->get('member_id'))->get();

            foreach($carts as $cart) {
               $cart->user_flg = 1;
               $cart->user_id = Auth::user()->id;
               $cart->save();
             }

        }

        return redirect('/');
      }else{
        return redirect()->back();
        }
      // return view('auth.singin');
    }

}
