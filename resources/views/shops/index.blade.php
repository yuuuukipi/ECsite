@extends('layouts.default')
@section('title','TOP')
@section('sidebar')
  @parent

@endsection

@section('content')
  <div class='container'>
    {{--<a href="{{ action('ShopsController@categoryShow')}}">カテゴリ一覧</a>
    <div class="btn-group dropright">
      <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        カテゴリ一覧
      </button>
      <div class="dropdown-menu">
        @foreach($categories as $category)
          <li role="presentation"><a href="{{ action('ShopsController@categoryDetail',$category)}}">{{$category->name}}</a></li>
        @endforeach
      </div>
    </div>


    <div class="dropdown">
    	<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
    		CATEGORY
    		<span class="caret"></span>
    	</button>
    	<ul class="dropdown-menu" role="menu">
        @foreach($categories as $category)
          <li role="presentation"><a href="{{ action('ShopsController@categoryDetail',$category)}}">{{$category->name}}</a></li>
        @endforeach
    	</ul>
    </div>
    --}}

    <br><p class="text-muted">New items</p>
      <div class="container">
          <div class="row">
            @foreach($products as $product)
              <div class="col-xs-4">
                @if($product->image=="")
                  <a href="{{ action('ShopsController@show', $product)}}"><img src="/images/noimage.png" alt="no image" class="img1"></a>
                @else
                  <a href="{{ action('ShopsController@show', $product)}}"><img src="/images/{{$product->image}}" alt="image" class="img1"></a>
                @endif
                <br>
                <a href="{{ action('ShopsController@show', $product)}}">{{$product->name}}</a>
                <a href="{{ action('ShopsController@show', $product)}}">{{$product->price}}</a>
              </div>
            @endforeach
          </div>
        </div>

  </div>



@endsection
