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
      <li class="order-bar-item">支払い方法</li>
      <li class="order-bar-item-select">ご注文内容確認</li>
      <li class="order-bar-item">ご注文完了</li>
    </ul>

      <div class="row">
      <p class="text-muted"><h2>ご注文内容の確認</h2></p><br>

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

          <form method="post" action="{{ action('OrderController@complete') }}">
            {{ csrf_field() }}
            <table class="table table-bordered" style="width:600px;">
              <thead>
                <tr bgcolor="#cfd6e4">
                  <td colspan="2">お客様情報</td>
                </tr>
                <tr>
                  <td scope="col" class="col-xs-3">名前</td>
                  <td><span>{{Auth::user()->name}}</span>
                  </td>
                </tr>
                <tr>
                  <td scope="col">メールアドレス</td>
                  <td>
                    <span>{{Auth::user()->email}}</span>
                  </td>
                </tr>
                <tr>
                  <td scope="col">電話番号</td>
                  <td>
                    <span>{{Auth::user()->phone}}</span>
                  </td>
                </tr>
                <tr>
                <td scope="col">住所</td>
                <td>
                  <span>〒{{Auth::user()->address->postal_code}}</span>
                  <span>{{Auth::user()->address->prefecture}}</span>
                  <span>{{Auth::user()->address->detail}}</span>
                </td>
                </tr>
              </tbody>
            </table>


            <table class="table table-bordered" style="width:600px;">
              <thead>
                <tr bgcolor="#cfd6e4">
                  <td colspan="2">お届け先情報</td>
                </tr>
                <tr>
                  <td scope="col" class="col-xs-3">名前</td>
                  <td><span>{{$history->send_name}}</span>
                    <input type="hidden" name="send_name" value="{{$history->send_name}}">
                  </td>
                </tr>
                <tr>
                  <td scope="col">メールアドレス</td>
                  <td>
                    <span>{{$history->send_email}}</span>
                    <input type="hidden" name="send_email" value="{{$history->send_email}}">
                  </td>
                </tr>
                <tr>
                  <td scope="col">電話番号</td>
                  <td>
                    <span>{{$history->send_phone}}</span>
                    <input type="hidden" name="send_phone" value="{{$history->send_phone}}">
                  </td>
                </tr>
                <tr>
                <td scope="col">住所</td>
                <td>
                  <span>〒{{$address->postal_code}}</span>
                  <input type="hidden" name="postal_code" value="{{$address->postal_code}}">
                  <span>{{$address->prefecture}}</span>
                  <input type="hidden" name="prefecture" value="{{$address->prefecture}}">
                  <span>{{$address->detail}}</span>
                  <input type="hidden" name="detail" value="{{$address->detail}}">
                </td>
                </tr>

              </tbody>
            </table>

            <table class="table table-bordered" style="width:600px;">
              <thead>
                <tr bgcolor="#cfd6e4">
                  <td colspan="2">お支払い方法</td>
                </tr>
                <tr>
                  @if($pay==0)
                  <td scope="col" class="col-xs-3">銀行振込</td>
                  <td class="col-xs-7">
                    ▼振込先情報<br>
                    金融機関名：ゆうちょ銀行<br>
                    支店名：○×支店<br>
                    口座種別：普通<br>
                    口座番号：0000000<br>
                    口座名義：イーシーサイト<br>
                  </td>
                  @elseif($pay==1)
                  <td scope="col" class="col-xs-3">代金引換</td>
                  <td class="col-xs-7">
                    代金引換は、商品のお届け時にお支払いする方法です。<br><br>
                    手数料は500円かかります。
                  </td>
                  @elseif($pay==2)
                  <td scope="col" class="col-xs-3">クレジットカード決済</td>
                  <td class="col-xs-7">
                    クレジットカードで決済します。<br>
                  </td>
                  @endif
                </tr>

              </tbody>
            </table>

            <div class="form-group">
                <div class="col-md-8 col-md-offset-2">
                    <button type="submit" class="btn btn-primary">
                        注文内容を確定する
                    </button>
                </div>
            </div>
            <input type="hidden" name="send_method" value="{{$pay}}">
          </form>

          </div>

      </div>
    </div>
  <script src="/js/main.js"></script>

@endsection
