<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','ShopsController@index');

//Auth
Auth::routes();

//ログイン
// Route::get('/login','Auth\LoginController@login')->name('login');
Route::post('/signin','Auth\LoginController@signin')->name('signin');

//会員登録確認画面
Route::post('/check','Auth\RegisterController@registerCheck')->name('registerCheck');
//会員登録完了画面
Route::post('/self/complete','Auth\RegisterController@registerComplete')->name('registerComplete');

/*ShopsController*/
//商品詳細画面
Route::get('item/{product}','ShopsController@show')->where('room', '[0-9]+');
// //カテゴリ一覧ページ
// Route::get('category','ShopsController@categoryShow')->where('category', '[0-9]+');
//カテゴリ別商品一覧ページ
Route::get('category/{category}','ShopsController@categoryDetail');
//全件表示
Route::get('items','ShopsController@allItems');

//検索機能
Route::get('search','ShopsController@search');


/*UsersController*/
//マイページ　会員情報
Route::get('mypage/info','UsersController@info');
//マイページ　会員情報　登録情報更新
Route::patch('mypage/info', 'UsersController@update')->name('update');
//マイページ　購入履歴
Route::get('mypage/history','UsersController@history');

/*OrderController*/
//カートに入れる
Route::post('order/cart','OrderController@addCart')->name('addCart');
//カート表示
Route::get('order/cart','OrderController@showCart');
//個数変更
Route::post('order/cart/{cart}','OrderController@editAmount')->name('editAmount');
//カートから商品削除
Route::delete('order/cart/{cart}', 'OrderController@destroy');

//お客様情報・届け先情報
Route::post('order/info/send', 'OrderController@sendCheck')->name('orderInfo');
//支払い方法
Route::post('order/info/pay', 'OrderController@payCheck')->name('payInfo');
//注文内容確認画面
Route::post('order/info/check', 'OrderController@finalyCheck')->name('fainalyCheck');
//注文完了
Route::post('order/info/complete', 'OrderController@complete');


// Route::get('/home', 'HomeController@index')->name('home');
