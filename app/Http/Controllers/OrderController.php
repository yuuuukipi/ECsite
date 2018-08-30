<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use App\User;
use App\Category;
use App\Control;
use App\History;
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

  //お客様情報・届け先情報
  public function sendCheck(request $request) {
    $categories = Category::all();
    $carts = Cart::select('*')
              ->where('comp_flg','=','0')
              ->where('user_id','=',Auth::user()->id)->get();

    //合計金額計算
    $price = 0;
    foreach ($carts as $cart) {
      $price = $price + $cart->product->price*1.08*$cart->amount;
    }
      return view('order.send_info')->with(['carts'=>$carts, 'categories'=>$categories, 'price'=>$price]);
  }

  //支払い方法
  public function payCheck(request $request) {
    // dd($request->all());
    $send_uesr=new User();
    $send_uesr->name=$request->name;
    $send_uesr->email=$request->email;
    $send_uesr->phone=$request->phone;
    $send_uesr->address=$request->address;

    $categories = Category::all();
    $carts = Cart::select('*')
              ->where('comp_flg','=','0')
              ->where('user_id','=',Auth::user()->id)->get();

    //合計金額計算
    $price = 0;
    foreach ($carts as $cart) {
      $price = $price + $cart->product->price*1.08*$cart->amount;
    }
      return view('order.pay_info')->with(['carts'=>$carts, 'categories'=>$categories, 'price'=>$price, 'send_uesr'=>$send_uesr]);
  }

  //注文内容最終確認
  public function finalyCheck(request $request) {
    // dd($request->pay);
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
      return view('order.check')->with(['carts'=>$carts, 'categories'=>$categories, 'price'=>$price, 'pay'=>$pay]);
  }

  //注文完了
  public function complete(request $request) {
    $categories = Category::all();
    $carts = Cart::select('*')
              ->where('comp_flg','=','0')
              ->where('user_id','=',Auth::user()->id)->get();

    $his_id = History::orderBy('id', 'desc')->first();
    $his_id=$his_id->order_id+1;

    foreach ($carts as $cart) {
      //historyのDB登録
      $history = new History();
      $history->order_id = $his_id;
      $history->product_id = $cart->product_id;
      $history->user_id = Auth::user()->id;
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
