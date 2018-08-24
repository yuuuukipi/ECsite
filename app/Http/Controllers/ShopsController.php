<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ms_product;
use App\Ms_category;
use App\Http\Controllers\Controller;

class ShopsController extends Controller
{
    //トップページ
    public function index(){
      $products = Ms_product::all(); //ルーム全件取得

      return view('shops.index')->with('products',$products);
    }

    //商品詳細ページ
    public function show(Ms_product $product){
      // dd($product);
      // $product->price=String($product->price).replace( /(\d)(?=(\d\d\d)+(?!\d))/g, '$1,');
      $product->price=$product->price*1.08;
      return view('shops.show')->with('product',$product);
    }

    //カテゴリ一覧ページ
    public function categoryShow(){
      $categories = Ms_category::all();
      return view('shops.category')->with('categories', $categories);
    }


}
