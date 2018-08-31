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
    	<li role="presentation" class="active"><a href="{{ action('UsersController@history')}}">購入履歴</a></li>
    </ul><br>

    <div class="container">
        <div class="row">
          @foreach($his_groups as $key=>$his_group)
          <p>購入日:</p>
          <p>注文番号:{{$his_group->order_id}}</p>
            <table class="table table-bordered" style="width: 80%">
              <thead>
                <tr>
                  <th scope="col" class="col-xs-2"></th>
                  <th scope="col" class="col-xs-3">商品名</th>
                  <th scope="col" class="col-xs-1">数量</th>
                  <th scope="col" class="col-xs-2">小計（税込）</th>
                </tr>
              </thead>
                @foreach($histories as $history)
                  <tbody>
                    <tr>
                      @if($history->order_id==$his_group->order_id)
                        <td><a href="{{ action('ShopsController@show', $history->product_id)}}">
                          @if($history->product->image=="")
                            <img src="/images/noimage.png" alt="no image" class="img2">
                          @else
                            <img src="/images/{{$history->product->image}}" alt="image" class="img2">
                          @endif
                        </a></td>
                        <td><a href="{{ action('ShopsController@show', $history->product_id)}}">{{$history->product->name}}</a></td>
                        <td><div>{{$history->amount}}</div></td>
                        <td>{{$history->product->price*1.08*$history->amount}}円（税込）</td>
                      @endif
                    </tr>
                  </tbody>
                @endforeach

                <tr><td align="right" colspan="4">合計金額（税込）：0円</td></tr>
                </tr>
            </table>
            @endforeach
          </div>
        </div>


  </div>



@endsection
