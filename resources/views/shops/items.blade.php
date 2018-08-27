@extends('layouts.default')
@section('title','TOP')
@section('sidebar')
  @parent

@endsection

@section('content')
  <div class='container'>
    <br><p class="text-muted">
      <a href="{{ action('ShopsController@index')}}">Top</a>
       >
       All
       </p>

    @foreach($products as $product)
    	<div class="col-xs-4">
          @if($product->image=="")
            <a href="{{ action('ShopsController@show', $product)}}"><img src="/images/noimage.png" alt="no image" class="img1"></a>
          @else
            <a href="{{ action('ShopsController@show', $product)}}"><img src="/images/{{$product->image}}" alt="image" class="img1"></a>
          @endif
        <br><a href="{{ action('ShopsController@show', $product)}}">{{$product->name}}</a>
        <br>{{$product->price}}円+税<br><br>
      </div>
    @endforeach

      </div>


  </div>



@endsection
