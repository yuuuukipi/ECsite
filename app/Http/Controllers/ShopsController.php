<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Http\Controllers\Controller;

class ShopsController extends Controller
{
    //トップページ
    public function index(){
      $products = Product::orderBy('created_at', 'DESC')->take(3)->get();
      $categories = Category::all();
      // dd($products);

      // foreach ($products as $key => $product) {
      //
      // }

      return view('shops.index')->with(['products'=>$products, 'categories'=>$categories]);
    }

    //商品詳細ページ
    public function show(Product $product){
      $categories = Category::all();

      // dd($product);
      // $product->price=String($product->price).replace( /(\d)(?=(\d\d\d)+(?!\d))/g, '$1,');
      $product->price=$product->price*1.08;
      return view('shops.show')->with(['product'=>$product, 'categories'=>$categories]);
    }

    // //カテゴリ一覧ページ
    // public function categoryShow(){
    //   $categories = Category::all();
    //   return view('shops.category')->with('categories', $categories);
    // }

    //カテゴリ一覧ページ
    public function categoryDetail(Category $category){
      // dd($category);
      $categories = Category::all();

      return view('shops.category_item')->with(['category'=>$category, 'categories'=>$categories]);
;
    }



}
