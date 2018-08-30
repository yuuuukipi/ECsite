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
      <li class="order-bar-item-select">お客様情報・お届け先情報</li>
      <li class="order-bar-item">支払い方法</li>
      <li class="order-bar-item">ご注文内容確認</li>
      <li class="order-bar-item">ご注文完了</li>
    </ul>

      <div class="row">

      @guest
        <div class="row">
          <div class="col-xs-3 col-md-5">
        		<div class="thumbnail">
        			<div class="caption">
                <h4 class="text-muted" style="text-align: center;">ログイン</h4><br>
                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">メールアドレス</label>

                        <div class="col-md-7">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">パスワード</label>

                        <div class="col-md-7">
                            <input id="password" type="password" class="form-control" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <div class="checkbox">
                                <label><input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> 会員情報を保存する</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                ログイン
                            </button>
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                パスワードをお忘れの方
                            </a>
                        </div>
                    </div>
                </form>

              </div>
            </div>
          </div>

          <div class="col-xs-3 col-md-5">
        		<div class="thumbnail">
        			<div class="caption">
                <h4 class="text-muted" style="text-align: center;">初めてのお客さま</h4><br>
                <p>　会員登録後、買い物を続けることができます。<br>
                  　登録は無料ですることができます。<br><br><br>
                  <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                      <div class="col-md-8 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            会員登録
                        </button>
                      </div>
                    </div>
                  </form>

                </p>
              </div>
            </div>
          </div>
        </div><br>
      @else
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

          <form method="post" action="{{ action('OrderController@payCheck') }}">
            {{ csrf_field() }}
            <table class="table table-bordered" style="width:600px;">
              <thead>
                <tr bgcolor="#cfd6e4">
                  <td colspan="2">お客様情報・お届け先情報</td>
                </tr>
                <tr>
                  <td scope="col" class="col-xs-3">名前</td>
                  <td class="col-xs-7">
                    <input type="text" name="name" size="30" value="{{old('name', Auth::user()->name) }}">
                  </td>
                </tr>
                <tr>
                  <td scope="col">メールアドレス</td>
                  <td>
                    <input type="text" name="email" size="40" value="{{old('email', Auth::user()->email) }}">
                  </td>
                </tr>
                <tr>
                  <td scope="col">電話番号</td>
                  <td>
                    <input type="text" name="phone" size="20" value="{{old('phone', Auth::user()->phone) }}">
                  </td>
                </tr>
                <tr>
                <td scope="col">住所</td>
                <td>
                  <input type="text" name="address" size="40" value="{{old('address', Auth::user()->address) }}">
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

          </form>

          </div>

      @endguest
      </div>
    </div>
  <script src="/js/main.js"></script>

@endsection
