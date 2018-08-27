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
       {{$category->name}}
       </p>

    @foreach($category->products as $category)
    	<div class="col-xs-5 col-md-4">
    		<div class="thumbnail">
    			<div class="caption">
            @if($category->image=="")
              <a href="{{ action('ShopsController@show', $category)}}"><img src="/images/noimage.png" alt="no image" class="img1"></a>
            @else
              <a href="{{ action('ShopsController@show', $category)}}"><img src="/images/{{$category->image}}" alt="image" class="img1"></a>
            @endif
        <br><a href="{{ action('ShopsController@show', $category)}}">{{$category->name}}</a>
        <br>{{$category->price}}円+税
      </div></div></div>
    @endforeach

      </div>


  </div>



@endsection
