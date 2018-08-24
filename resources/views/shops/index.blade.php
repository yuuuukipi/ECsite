@extends('layouts.app')
@section('title','TOP')
@section('sidebar')
  @parent

@endsection

@section('content')
  <div class='container'>
    <br><p class="text-muted">reccomend items</p>
    <a href="{{ action('ShopsController@categoryShow')}}">カテゴリ一覧</a>

    @foreach($products as $product)
      <div>
        {{$product->name}}
        <a href="{{ action('ShopsController@show', $product)}}">商品詳細画面</a>
      </div>
    @endforeach

  </div>



@endsection
