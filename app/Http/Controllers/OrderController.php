<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use App\User;
use App\Category;
use App\Control;
use App\History;
use App\Address;
use App\Card;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
  //カートに入れる
  public function addCart(request $request){
    //在庫数チェック
    $num = Control::select('*')->where('product_id','=',$request->product)
                  ->get();

    if($request->amount>$num[0]->amount){
      //TODO エラーの表示方法調べる
      return view('shops.index')->with(['products'=>$products, 'categories'=>$categories]);
    }

    //ログインしていない場合
    if(Auth::user()==null){
      //sessionにデータある場合
      // dd($request->session());
      if($request->session()->get('member_id')!==null){
        // dd($request->session());
        $member_id = $request->session()->get('member_id');
        // dd($member_id);

      }else{
        //error
        $member_id = Cart::select('*')
                  ->where('comp_flg','=','0')
                  ->orderBy('member_id','desc')
                  ->first();
        $member_id = $member_id->member_id+1;
            // dd($member_id->member_id+1);
        $request->session()->put('member_id', $member_id);
        // dd($request->session()->get('member_id'));
        // dd($request->session());
      }
      // dd($member_id);

        $eddit_carts = Cart::select('*')
                  ->where('comp_flg','=','0')
                  ->where('user_flg','=','0')
                  ->where('member_id','=',$member_id)->get();

        //同じ商品だったら個数だけ変更する
        $i=0;
         foreach($eddit_carts as $eddit_cart) {
            if($eddit_cart->product_id == $request->product){
              $eddit_cart->amount = $eddit_cart->amount+$request->amount;
              $eddit_cart->save();
              $i=1;
            }
          }
// dd($member_id);
        //新しい商品の場合、新規登録する
        if($i==0){
          $cart = new Cart();
          // $cart->user_id = Auth::user()->id;
          $cart->product_id = $request->product;
          $cart->amount = $request->amount;
          $cart->comp_flg = 0; //0:未完了 1:完了
          $cart->user_flg = 0; //0:非会員 1:会員
          $cart->member_id = $member_id;
          $cart->save();

        }
    }else{
      //ログインしている場合
      $eddit_carts = Cart::select('*')
                ->where('comp_flg','=','0')
                ->where('user_id','=',Auth::user()->id)->get();

      $i=0;
      //同じ商品だったら個数だけ変更する
       foreach($eddit_carts as $eddit_cart) {
          if($eddit_cart->product_id == $request->product){
            $eddit_cart->amount = $eddit_cart->amount+$request->amount;
            $eddit_cart->save();
            // $i=1;
          }
        }

      if($i==0){
        $cart = new Cart();
        $cart->user_id = Auth::user()->id;
        $cart->product_id = $request->product;
        $cart->amount = $request->amount;
        $cart->comp_flg = 0; //0:未完了 1:完了
        $cart->user_flg = 1; //0:非会員 1:完了
        $cart->save();
      }
    }
    // dd($request->session());
    return redirect()->action('OrderController@showCart');
  }

  //カートの表示
  public function showCart(request $request){
    // dd($request->session());
    $categories = Category::all();
    //ログインしていない場合
    if(Auth::user()==null){
      // dd($request->session());

      //自身のカート内に絞る
      $carts = Cart::select('*')
                ->where('user_flg','=','0')
                ->where('comp_flg','=','0')
                ->where('member_id','=',$request->session()->get('member_id'))->get();
    //ログインしている場合
    }else{
      //自身のカート内に絞る
      $carts = Cart::select('*')
                ->where('comp_flg','=','0')
                ->where('user_flg','=','1')
                ->where('user_id','=',Auth::user()->id)->get();
    }
      //合計金額計算
      $price = 0;
      foreach ($carts as $cart) {
        $price = $price + $cart->product->price*1.08*$cart->amount;
      }
      //TODO 0件のやつ消す
    return view('order.cart')->with(['carts'=>$carts, 'categories'=>$categories, 'price'=>$price, 'request'=>$request]);
  }

  //個数変更
  public function editAmount(request $request){
    $carts = Cart::all();

    foreach($carts as $cart) {
       if($cart->product_id == $request->id){
         $cart->amount = $request->amount;
         $cart->save();
       }
     }

    return redirect()->action('OrderController@showCart');
  }

  //カートから商品削除
  public function destroy(cart $cart) {
      $cart->delete();
      return redirect()->action('OrderController@showCart');
  }

  //お客様情報・届け先情報
  public function sendCheck(request $request) {
    $categories = Category::all();

    //ログインしていない場合
    if(Auth::user()==null){
      //自身のカート内に絞る
      $carts = Cart::select('*')
                ->where('user_flg','=','0')
                ->where('comp_flg','=','0')
                ->where('member_id','=',$request->session()->get('$member_id'))->get();
    //ログインしている場合
    }else{
      //自身のカート内に絞る
      $carts = Cart::select('*')
                ->where('comp_flg','=','0')
                ->where('user_flg','=','1')
                ->where('user_id','=',Auth::user()->id)->get();

    }

    //合計金額計算
    $price = 0;
    foreach ($carts as $cart) {
      $price = $price + $cart->product->price*1.08*$cart->amount;
    }
      return view('order.send_info')->with(['carts'=>$carts, 'categories'=>$categories, 'price'=>$price]);
  }

  //支払い方法
  public function payCheck(request $request) {

    $history = new History();
    $history->send_name = $request->name;
    $history->send_email = $request->email;
    $history->send_phone = $request->phone;

    $address = new Address();
    $address->postal_code = $request->postal_code;
    $address->prefecture = $request->prefecture;
    $address->detail = $request->detail;


    $categories = Category::all();
    $carts = Cart::select('*')
              ->where('comp_flg','=','0')
              ->where('user_id','=',Auth::user()->id)->get();

    //合計金額計算
    $price = 0;
    foreach ($carts as $cart) {
      $price = $price + $cart->product->price*1.08*$cart->amount;
    }
      return view('order.pay_info')->with(['carts'=>$carts, 'categories'=>$categories, 'price'=>$price, 'address'=>$address, 'history'=>$history]);
  }

  //注文内容最終確認
  public function finalyCheck(request $request) {
    // dd($request);
    //カード払いの場合、カード情報の登録
    if($request->pay==2){
      //カード情報登録してある場合
      // dd(Auth::user()->card_id!=null);
      if(Auth::user()->card_id!=null){
        //元からあるカードテーブルの内容を変更する
        $card = Card::select('*')
                ->where('id','=',Auth::user()->card_id)
                ->get();
                // dd($card);
        $card[0]->card_num = $request->card_num;
        $card[0]->ex_year = $request->ex_year;
        $card[0]->ex_month = $request->ex_month;
        $card[0]->name = $request->name;
        $card[0]->security_code = $request->security_code;
        $card[0]->save();

      //カード情報登録してない場合
      }else{
        //カードテーブルに新規登録
        $card = new Card();
        $card->card_num = $request->card_num;
        $card->ex_year = $request->ex_year;
        $card->ex_month = $request->ex_month;
        $card->name = $request->name;
        $card->security_code = $request->security_code;
        $card->save();

        //上のカードIDをユーザーのカードIDに登録
        Auth::user()->card_id = $card->id;
        Auth::user()->save();
      }
    }

    $address = new Address();
    $address->postal_code = $request->postal_code;
    $address->prefecture = $request->prefecture;
    $address->detail = $request->detail;

    $history = new History();
    $history->send_name = $request->send_name;
    $history->send_email = $request->send_email;
    $history->send_phone = $request->send_phone;
    $history->send_method = $request->pay;
    // dd($history);

    $categories = Category::all();
    $carts = Cart::select('*')
              ->where('comp_flg','=','0')
              ->where('user_id','=',Auth::user()->id)->get();

    //合計金額計算
    $price = 0;
    foreach ($carts as $cart) {
      $price = $price + $cart->product->price*1.08*$cart->amount;
    }
    $pay = $request->pay;
      return view('order.check')->with(['carts'=>$carts, 'categories'=>$categories, 'price'=>$price, 'pay'=>$pay , 'address'=>$address, 'history'=>$history]);
  }

  //注文完了
  public function complete(request $request) {
    // dd($request);
    $categories = Category::all();
    $carts = Cart::select('*')
              ->where('comp_flg','=','0')
              ->where('user_id','=',Auth::user()->id)->get();

    $his_id = History::orderBy('id', 'desc')->first();
    if($his_id==null){
      $his_id=1;
    }else{
      $his_id=$his_id->order_id+1;
    }

    //addressテーブルのDB登録
    $address = new Address();
    $address->postal_code = $request->postal_code;
    $address->prefecture = $request->prefecture;
    $address->detail = $request->detail;
    $address->save();

    $add_id = Address::orderBy('id', 'desc')->first();
    $add_id=$add_id->id;


    foreach ($carts as $cart) {
      //historyのDB登録
      $history = new History();
      $history->order_id = $his_id;
      $history->product_id = $cart->product_id;
      $history->user_id = Auth::user()->id;
      $history->amount = $cart->amount;
      $history->send_name = $request->send_name;
      $history->send_email = $request->send_email;
      $history->address_id = $add_id;
      $history->send_phone = $request->send_phone;
      $history->send_method = $request->send_method;
      $history->save();

      //在庫テーブル更新
      $control = Control::select('*')
              ->where('product_id','=',$cart->product_id)->get();
              // dd(Auth::user());
              // dd($control[0]);
      $control[0]->amount = $control[0]->amount - $cart->amount;
      $control[0]->save();

      //cartテーブルを完了フラグつける
      $cart->comp_flg=1;
      $cart->save();

    }


    // dd("完了");

    return view('order.complete')->with(['categories'=>$categories,'his_id'=>$his_id]);
  }


}
