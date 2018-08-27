@extends('layouts.app')
@section('title','TOP')
@section('sidebar')
  @parent

@endsection

@section('content')
  <div class='container'>
    <p class="text-muted"><h2>My Page</h2></p><br>


    <ul class="nav nav-tabs">
    	<li role="presentation"><a href="{{ action('UsersController@info')}}">会員情報</a></li>
    	<li role="presentation"><a href="{{ action('UsersController@history')}}">購入履歴</a></li>
    </ul>


  </div>



@endsection
