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

      return view('shops.category')->with(['category'=>$category, 'categories'=>$categories]);

    }

    //商品全件表示
    public function allItems(){
      $categories = Category::all();
      $products = Product::all();

      return view('shops.items')->with(['products'=>$products, 'categories'=>$categories]);

    }


    //検索結果一覧表示ページ
    public function search(Request $request){
      $categories = Category::all();
      $query = Product::query();
      // $products = Product::get();
      if(!empty($request)){
          // dd(1);
          $query->orWhere('name','like','%'.$request->word.'%');
          $query->orWhere('comment','like','%'.$request->word.'%');
      }
      $results=$query->get();
      $count=count($results);
      // dd($count);
      // dd($request->word);
      // $categories = Category::all();

      return view('shops.search')->with(['results'=>$results, 'categories'=>$categories, 'count'=>$count]);

    }

}
