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
      <li class="order-bar-item">ご注文内容確認</li>
      <li class="order-bar-item-select">ご注文完了</li>
    </ul>

      <div class="row">
      <p class="text-muted"><h2>注文が完了しました。<br>
        お客様の注文番号は、{{$his_id}}です。<br>
      </h2></p><br>

    </div>
  <script src="/js/main.js"></script>

@endsection
