@extends('layouts.default')
@section('title','TOP')
@section('sidebar')
  @parent

@endsection

@section('content')
  <div class='container'>

    <br><p class="text-muted"><h2>Search Result：{{$count}}件</h1></p>
      <div class="container">
          <div class="row">
            @foreach($results as $result)
              <div class="col-xs-4">
                @if($result->image=="")
                  <a href="{{ action('ShopsController@show', $result)}}"><img src="/images/noimage.png" alt="no image" class="img1"></a>
                @else
                  <a href="{{ action('ShopsController@show', $result)}}"><img src="/images/{{$result->image}}" alt="image" class="img1"></a>
                @endif
                <br>
                <a href="{{ action('ShopsController@show', $result)}}">{{$result->name}}</a>
                <p>{{$result->price}}円+税</p>
              </div>
              @endforeach
          </div>
        </div>

    </div>



@endsection
