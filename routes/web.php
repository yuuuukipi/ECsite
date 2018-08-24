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
//会員登録確認画面
Route::post('/check','Auth\RegisterController@registerCheck')->name('registerCheck');
//会員登録完了画面
Route::post('/self/complete','Auth\RegisterController@registerComplete')->name('registerComplete');

//ShowsController
//商品詳細画面
Route::get('item/{product}','ShopsController@show')->where('room', '[0-9]+');
//カテゴリ一覧ページ
Route::get('category','ShopsController@categoryShow')->where('category', '[0-9]+');

Route::get('/home', 'HomeController@index')->name('home');
