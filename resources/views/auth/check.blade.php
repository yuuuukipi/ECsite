@extends('layouts.app')
@section('title','TOP')
@section('sidebar')
  @parent
  <br><p class="text-muted text-center">会員登録入力確認画面</p>

@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">入力情報確認画面</div>
          <div class="panel-body">

            <form class="form-horizontal" method="POST" action="{{ route('registerComplete') }}">
              {{ csrf_field() }}
              <div class="col-form-label">名前：
                <span>{{$user->name}}</span>
                <input type="hidden" name="name" value="{{$user->name}}">
              </div>

              <div class="col-form-label">メールアドレス：
                <span>{{$user->email}}</span>
                <input type="hidden" name="email" value="{{$user->email}}">
              </div>

              <div class="col-form-label">パスワード：
                <span>******</span>
                <input type="hidden" name="password" value="{{$user->password}}">
              </div>

              <div class="col-form-label">性別：
                @if($user->gender==0)
                  <span>男</span>
                @else
                  <span>女</span>
                @endif
                <input type="hidden" name="gender" value="{{$user->gender}}">
              </div>


              <div class="ol-form-label">生年月日：
                <span>{{$user->birthday}}</span>
                <input type="hidden" name="birthday" value="{{$user->birthday}}">
              </div>

              <div class="col-form-label">郵便番号：
                <span>{{$address->postal_code}}</span>
                <input type="hidden" name="postal_code" value="{{$address->postal_code}}">
              </div>

              <div class="col-form-label">都道府県：
                <span>{{$address->prefecture}}</span>
                <input type="hidden" name="prefecture" value="{{$address->prefecture}}">
              </div>

              <div class="col-form-label">住所：
                <span>{{$address->detail}}</span>
                <input type="hidden" name="detail" value="{{$address->detail}}">
              </div>

            <div class="col-form-label">電話番号：
              <span>{{$user->phone}}</span>
              <input type="hidden" name="phone" value="{{$user->phone}}">
            </div>
            <br>
            <div class="form-group">
                <div class="col-md-9 col-md-offset-1">
                    <button type="submit" class="btn btn-primary">
                        登録
                    </button>
                </div>
            </div>

            <input type="hidden" name="token" value="{{$token}}">
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>

@endsection
