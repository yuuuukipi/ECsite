@extends('layouts.app')
@section('title','TOP')
@section('sidebar')
  @parent

@endsection

@section('content')
  <div class='container'>
    <p class="text-muted"><h2>My Page</h2></p><br>

    <ul class="nav nav-tabs" style="width:600px;">
    	<li role="presentation" class="active"><a href="{{ action('UsersController@info')}}">会員情報</a></li>
    	<li role="presentation"><a href="{{ action('UsersController@history')}}">購入履歴</a></li>
    </ul>

  <form method="post" action="{{ route('update') }}">
    {{ csrf_field() }}
    {{ method_field('patch') }}
    <table class="table" style="width:600px;">
      <thead>
        <tr>
          <td scope="col" class="col-xs-3">名前</td>
          <td class="col-xs-6">
            <input type="text" name="name" value="{{old('name', Auth::user()->name) }}">
          </td>
        </tr>
        <tr>
          <td scope="col">メールアドレス</td>
          <td>
            <input type="text" name="email" value="{{old('email', Auth::user()->email) }}">
          </td>
        </tr>
        <tr>
          <td scope="col">性別</td>
          <td>
            <div class="radio-inline">
                  <input type="radio" name="gender" value="0" @if(old('gender')!='1')checked="checked"@endif>
                  <label for="gender0">男</label>
            </div>
            <div class="radio-inline">
                  <input type="radio" name="gender" value="1" @if(old('gender')=='1')checked="checked"@endif>
                  <label for="gender1">女</label>
            </div>

          </td>
        </tr>
        <tr>
          <td scope="col">生年月日</td>
          <td>
            <input type="text" size="4" name="birthday1" value="{{ substr(old('birthday', Auth::user()->birthday),0,4) }}" required autofocus>
            年<input type="text" size="2" name="birthday2" value="{{ substr(old('birthday',Auth::user()->birthday),5,2) }}" required autofocus>
            月<input itype="text" size="2" name="birthday3" value="{{ substr(old('birthday',Auth::user()->birthday),8,2) }}" required autofocus>
            日
        </td>
        </tr>
        <tr>
          <td scope="col">電話番号</td>
          <td>
            <input type="text" name="phone" value="{{old('phone', Auth::user()->phone) }}">
          </td>
        </tr>
        <tr>
        <td scope="col">住所</td>
        <td>
          <input type="text" name="address" value="{{old('address', Auth::user()->address) }}">
        </td>
        </tr>

      </tbody>
    </table>

    <div class="form-group">
        <div class="col-md-8 col-md-offset-2">
            <button type="submit" class="btn btn-primary">
                更新
            </button>
        </div>
    </div>

  </form>



  </div>


@endsection
