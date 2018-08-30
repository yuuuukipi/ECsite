@extends('layouts.default')
@section('title','TOP')
@section('sidebar')
  @parent

@endsection

@section('content')
  <div class='container'>
    <br>
    <ul class="order-bar">
      <li class="order-bar-item-select">ショッピングカート</li>
      <li class="order-bar-item">お客様情報・お届け先情報</li>
      <li class="order-bar-item">支払い方法</li>
      <li class="order-bar-item">ご注文内容確認</li>
      <li class="order-bar-item">ご注文完了</li>
    </ul>

    <p class="text-muted"><h2>Cart</h2></p><br>
    <div class="container">
        <div class="row">
            <table class="table" style="width: 60%">
              <thead>
                <tr>
                  <th scope="col" class="col-xs-1" style="width: 1%;">No</th>
                  <th scope="col" class="col-xs-1">Item</th>
                  <th scope="col" class="col-xs-2"></th>
                  <th scope="col" class="col-xs-2">Price</th>
                  <th scope="col" class="col-xs-1">Amount</th>
                  <th scope="col" class="col-xs-2" style="width: 1%;"></th>
                </tr>
              </thead>
              @forelse($carts as $key=>$cart)
              <tbody>
                <tr>
                  <th scope="row">{{$key+1}}</th>
                  <td><a href="{{ action('ShopsController@show', $cart->product)}}">
                    @if($cart->product->image=="")
                      <img src="/images/noimage.png" alt="no image" class="img2">
                    @else
                      <img src="/images/{{$cart->product->image}}" alt="image" class="img2">
                    @endif
                  </a></td>
                  <td><a href="{{ action('ShopsController@show', $cart->product)}}">{{$cart->product->name}}</a></td>
                  <td>{{$cart->product->price*1.08}}円（税込）</td>
                  <td>
                    <form class="form-horizontal" method="POST"  action="{{ route('editAmount',$cart) }}">
                      {{ csrf_field() }}
                      <input type="text" name="amount" size="2" value="{{old('amount', $cart->amount) }}">個<br><br>
                      <input type="hidden" name="id" value="{{$cart->product->id}}">
                      <div class="form-group">
                        <button type="submit">
                            変更する
                        </button>
                      </div>
                    </form>

                  </td>
                  <td style="font-size:25px;">

                    <form action="{{ action('OrderController@destroy', $cart) }}" id="form_{{ $cart->id }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}
                    <a href="#" data-id="{{ $cart->id }}" onclick="deletePost(this);">×</a>
                    </form>

                  </td>
                </tr>
                @empty
                  <p class="text-muted">カートに商品が入っていません</p>
                @endforelse
              </table>
            <p class="text-muted">合計金額：{{$price}}円（税込）</p>

          <form class="form-horizontal" method="POST" action="{{action('OrderController@sendCheck')}}">
            {{ csrf_field() }}
            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    購入手続きへ進む
                </button>
            </div>
            <input type="hidden" name="carts" value="{{$carts}}">
          </form>


          <a href="{{action('ShopsController@index')}}" class="text-muted">買い物に戻る</a>

        </div>
      </div>
    </div>
  <script src="/js/main.js"></script>

@endsection
