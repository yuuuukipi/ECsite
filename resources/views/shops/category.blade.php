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
       <p class="text-muted">
          <div class="dropdown">並び替え
            <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true">
              新着
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
              <li><a href="#">新着</a></li>
              <li><a href="#">価格低</a></li>
              <li><a href="#">価格高</a></li>
            </ul>
          </div>
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
          </div>
        </div>
      </div>
    @endforeach

    <br><br><br>
    <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-center pagination-sm">
        <li class="page-item disabled">
          <a class="page-link" href="#" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
          </a>
        </li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
          <a class="page-link" href="#" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
          </a>
        </li>
      </ul>
    </nav>
  </div>





@endsection
