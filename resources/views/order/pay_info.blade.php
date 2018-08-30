@extends('layouts.default')
@section('title','TOP')
@section('sidebar')
  @parent

@endsection

@section('content')
  <div class='container'>
    <br>
    <ul class="order-bar">
      <li class="order-bar-item">ショッピングカート</li>
      <li class="order-bar-item">お客様情報・お届け先情報</li>
      <li class="order-bar-item-select">支払い方法</li>
      <li class="order-bar-item">ご注文内容確認</li>
      <li class="order-bar-item">ご注文完了</li>
    </ul>

    <div class="row">
      <div class="container">
          <div class="row">
              <table class="table table-bordered" style="width: 80%">
                <thead>
                  <tr>
                    <th scope="col" class="col-xs-2"></th>
                    <th scope="col" class="col-xs-3">商品名</th>
                    <th scope="col" class="col-xs-1">数量</th>
                    <th scope="col" class="col-xs-2">小計（税込）</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($carts as $key=>$cart)
                    <tr>
                    <td><a href="{{ action('ShopsController@show', $cart->product)}}">
                      @if($cart->product->image=="")
                        <img src="/images/noimage.png" alt="no image" class="img2">
                      @else
                        <img src="/images/{{$cart->product->image}}" alt="image" class="img2">
                      @endif
                    </a></td>

                    <td><a href="{{ action('ShopsController@show', $cart->product)}}">{{$cart->product->name}}</a></td>
                    <td><div>{{$cart->amount}}</div></td>
                    <td>{{$cart->product->price*1.08*$cart->amount}}</td>
                    </tr>
                    @endforeach
                    <tr><td align="right" colspan="4">合計金額（税込）：{{$price}}円</td></tr>
                  </tr>
              </table>
            </div>
          </div>

          <form method="post" action="{{ action('OrderController@finalyCheck') }}">
            {{ csrf_field() }}
            <table class="table table-bordered" style="width:600px;">
              <thead>
                <tr bgcolor="#cfd6e4">
                  <td colspan="2">お支払い方法の選択</td>
                </tr>

                <tr>
                  <td scope="col" class="col-xs-3">
                    <input type="radio" name="pay" value="0">銀行振込</td>
                  <td class="col-xs-7">
                    ▼振込先情報<br>
                    金融機関名：ゆうちょ銀行<br>
                    支店名：○×支店<br>
                    口座種別：普通<br>
                    口座番号：0000000<br>
                    口座名義：イーシーサイト<br>
                  </td>
                </tr>
                <tr>
                  <td scope="col">
                    <input type="radio" name="pay" value="1">代金引換</td>
                  <td>
                    代金引換は、商品のお届け時にお支払いする方法です。<br><br>
                    手数料は500円かかります。
                  </td>
                </tr>
                <tr>
                  <td scope="col">
                    <input type="radio" name="pay" value="2">クレジットカード決済</td>
                  <td>
                    クレジットカードで決済します。<br>
                    クレジットカード決済の場合は、以下にカード情報の入力をしてください。<br>
                    <div>カード番号</div>
                    <!-- <textarea name="comment" placeholder="コメント" size="20" class="form-control" rows="1">aaa</textarea> -->
                    <input type="text" name="card_num" size="20" value="{{old('card_num') }}">
                    <div>有効期限</div>
                    <input type="text" name="card_day" size="20" value="{{old('card_day') }}">
                    <div>カード名義</div>
                    <input type="text" name="card_name" size="20" value="{{old('card_name') }}">
                    <div>セキュリティコード</div>
                    <input type="text" name="card_cord" size="20" value="{{old('card_cord') }}">
                    <br>
                  </td>
                </tr>

              </tbody>
            </table>

            <div class="form-group">
                <div class="col-md-8 col-md-offset-2">
                    <button type="submit" class="btn btn-primary">
                        次へ
                    </button>
                </div>
            </div>
            <input type="hidden" name="users" value="{{$send_uesr}}">

          </form>

      </div>
    </div>
  <script src="/js/main.js"></script>

@endsection
