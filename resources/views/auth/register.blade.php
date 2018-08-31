@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">新規会員登録</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('registerCheck') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">名前</label>
                            <div class="col-md-6">

                                <input id="name" type="text" size="20" name="name" value="{{ old('name') }}" required autofocus>
                                <span style="font-size:12px; color:tomato;">※必須</span>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">メールアドレス</label>

                            <div class="col-md-6">
                                <input id="email" type="email" size="35" name="email" value="{{ old('email') }}" required>
                                <span style="font-size:12px; color:tomato;">※必須</span>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">パスワード</label>
                            <div class="col-md-6">
                                <input id="password" type="password" size="20" name="password" required>
                                <span style="font-size:12px; color:tomato;">※必須</span>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">パスワード確認</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" size="20" name="password_confirmation" required>
                                <span style="font-size:12px; color:tomato;">※必須</span>
                            </div>
                        </div>

                        <!-- <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}"> -->
                        <label for="gender" class="col-md-4 control-label">性別</label>

                        <div class="radio-inline">
                                <input type="radio" name="gender" value="0">
                                <label for="gender0">男</label>
                        </div>
                        <div class="radio-inline">
                                <input type="radio" name="gender" value="1">
                                <label for="gender1">女</label>
                        </div>
                        <span style="font-size:12px; color:tomato;">※必須</span>
                          @if ($errors->has('gender'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('gender') }}</strong>
                              </span>
                          @endif
                          <br>


                        <div class="form-group{{ $errors->has('birthday') ? ' has-error' : '' }}">
                            <label for="birthday" class="col-md-4 control-label">生年月日</label>

                            <div class="col-md-6">
                                <input id="birthday1" type="text" size="4" name="birth_year" value="{{ old('birth_year') }}" required autofocus>
                                年<input id="birthday2" type="text" size="2" name="birth_month" value="{{ old('birth_month') }}" required autofocus>
                                月<input id="birthday3" type="text" size="2" name="birth_day" value="{{ old('birth_day') }}" required autofocus>
                                日
                                <span style="font-size:12px; color:tomato;">※必須</span>
                                @if ($errors->has('birthday'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('birthday') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('postal_code') ? ' has-error' : '' }}">
                            <label for="postal_code" class="col-md-4 control-label">郵便番号</label>

                            <div class="col-md-6">
                                <input id="postal_code" type="text" size="10" name="postal_code" value="{{ old('postal_code') }}" required autofocus>
                                <span style="font-size:12px; color:tomato;">※必須</span>

                                @if ($errors->has('postal_code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('postal_code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('prefecture') ? ' has-error' : '' }}">
                            <label for="prefecture" class="col-md-4 control-label">住所（都道府県）</label>

                            <div class="col-md-6">
                                <input id="prefecture" type="text" size="10" name="prefecture" value="{{ old('prefecture') }}" required autofocus>
                                <span style="font-size:12px; color:tomato;">※必須</span>
                                @if ($errors->has('prefecture'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('prefecture') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('detail') ? ' has-error' : '' }}">
                            <label for="detail" class="col-md-4 control-label">住所（市町村以降）</label>

                            <div class="col-md-6">
                                <input id="detail" type="text" size="55" name="detail" value="{{ old('detail') }}" required autofocus>
                                <span style="font-size:12px; color:tomato;">※必須</span>
                                @if ($errors->has('detail'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('detail') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">電話番号</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" size="20" name="phone" value="{{ old('phone') }}" required autofocus>
                                <span style="font-size:12px; color:tomato;">※必須</span>
                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>




                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    確認
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
