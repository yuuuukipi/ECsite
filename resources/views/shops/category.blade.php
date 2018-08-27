@extends('layouts.app')
@section('title','TOP')
@section('sidebar')
  @parent

@endsection

@section('content')
  <div class='container'>
    <br><p class="text-muted">カテゴリ一覧</p>

    @foreach($categories as $category)
      <a href="{{ action('ShopsController@categoryDetail',$category)}}">{{$category->name}}</a><br>
    @endforeach

      </div>


  </div>



@endsection
