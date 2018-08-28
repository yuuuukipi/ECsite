<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use App\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
  //カートに入れる
  public function addCart(request $request){
    $eddit_carts = Cart::select('*')
              ->where('comp_flg','=','0')
              ->where('user_id','=',Auth::user()->id)->get();
              // dd(1234);

    $i=0;
     foreach($eddit_carts as $eddit_cart) {
        if($eddit_cart->product_id == $request->product){
          $eddit_cart->amount = $eddit_cart->amount+$request->amount;
          $eddit_cart->save();
          $i=1;
        }
      }

      if($i==0){
        $cart = new Cart();
        $cart->user_id = Auth::user()->id;
        $cart->product_id = $request->product;
        $cart->amount = $request->amount;
        $cart->comp_flg = 0; //0:未完了 1:完了
        $cart->save();
      }

    return redirect()->action('OrderController@showCart');
  }

  //カートの表示
  public function showCart(){
    $categories = Category::all();
    //自身のカート内に絞る
    $carts = Cart::select('*')
              ->where('comp_flg','=','0')
              ->where('user_id','=',Auth::user()->id)->get();

    //合計金額計算
    $price = 0;
    foreach ($carts as $cart) {
      $price = $price + $cart->product->price*1.08*$cart->amount;
    }
    //TODO 0件のやつ消す

    return view('order.cart')->with(['carts'=>$carts, 'categories'=>$categories, 'price'=>$price]);
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


}
