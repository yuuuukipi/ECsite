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
       <a href="{{ action('ShopsController@categoryDetail',$product->category)}}">{{$product->category->name}}</a>
       >
       {{$product->name}}
       </p>
      <div class="left_wrap">
        @if($product->image=="")
          <img src="/images/noimage.png" alt="no image" class="img_main">
        @else
          <img src="/images/{{$product->image}}" alt="image" class="img_main">
        @endif
      </div>

      <div class="right_wrap">
        <h1>{{$product->name}}</h1>
        <h2>{{$product->price}}円(税込)</h2><br>
        <p>{!! nl2br(e($product->comment)) !!}</p><br><br>

        <p>数量<input type="text" name="amount" value="1" size="2" maxlength="9" required autofocus></p>

        <div class="form-group">
            <div class="col-md-12 col-md-offset-0">
                <button type="submit" class="btn btn-primary">
                    カートに入れる
                </button>
            </div>
        </div>

      </div>




  </div>



@endsection
