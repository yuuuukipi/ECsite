<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Address;
use App\Cart;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
        $categories = Category::all();

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    // protected function validator(array $data)
    // {
    //   // dd($data);
    //     return Validator::make($data, [
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users',
    //         'password' => 'required|string|min:6|confirmed',
    //         'gender' => 'required',
    //         // 'birthday' => 'required',
    //         'birth_year' => 'required',
    //         'birth_month' => 'required',
    //         'birth_day' => 'required',
    //         'address' => 'required',
    //         'phone' => 'required',
    //     ]);
    // }


    //登録情報確認画面
    public function registerCheck(Request $request){
      $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6|confirmed',
        'gender' => 'required',
        // 'birthday' => 'required',
        'birth_year' => 'required',
        'birth_month' => 'required',
        'birth_day' => 'required',
        'postal_code' => 'required',
        'prefecture' => 'required',
        'detail' => 'required',
        'phone' => 'required',
      ]);

      $birthday=$request->birth_year.$request->birth_month.$request->birth_day;


      $address = new Address();
      $address->postal_code = $request->postal_code;
      $address->prefecture = $request->prefecture;
      $address->detail = $request->detail;

      $user = new User();
      $user->name=$request->name;
      $user->email=$request->email;
      $user->password=$request->password;
      $user->gender=$request->gender;
      $user->birthday=$birthday;
      // $user->address_id=$address_num;
      $user->phone=$request->phone;
      $token = md5(uniqid(rand(), true));
      $request->session()->put('token', $token);


      return view('auth.check')->with(['user'=>$user, 'token'=>$token, 'address'=>$address]);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function registerComplete(request $request)
    {
      $user_token=$request->get('token');
      if($request->session()->get('token') !== $user_token){
        dd("エラー");
        return redirect('/');
      }
        $request->session()->forget('token');

        $address = new Address();
        $address->postal_code = $request->postal_code;
        $address->prefecture = $request->prefecture;
        $address->detail = $request->detail;
        $address->save();

        $address_num = Address::orderBy('id', 'desc')->first();
        // if($address_num==null){
        //   $address_num = 0;
        // }else{
          $address_num = $address_num->id;
        // }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->gender = $request->gender;
        $user->birthday = $request->birthday;
        $user->address_id=$address_num;
        $user->phone = $request->phone;
        $user->save();

        //カートに商品が入っている場合
        if($request->session()->get('member_id')!=null){
          $carts = Cart::select('*')
                    ->where('user_flg','=','0')
                    ->where('comp_flg','=','0')
                    ->where('member_id','=',$request->session()->get('member_id'))->get();

            foreach($carts as $cart) {
               $cart->user_flg = 1;
               $cart->user_id = $user->id;
               $cart->save();
             }

          // $request->session()->flush;
        }

      if(Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')])){
        return redirect('/');
      }

      return view('shops.index');
    }
}
