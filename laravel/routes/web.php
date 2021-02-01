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

//ログインフォームのリクエスト
Route::get('/test', 'TestController@test');
//ログインフォームのpostリクエスト
Route::post('/test', 'TestController@testPos');
//ログイン成功後のtop画面へのリクエスト
Route::get('/top', 'TestController@top');
//ログアウトのリンクを踏んだ際のリクエスト
Route::get('/logout', 'TestController@logout');

//サイト情報のlist画面へのリクエスト（top画面からのリンク）
//またソートリンクを踏んだ際のリクエストでもある
Route::get('/list', 'SiteController@list');
//edit画面へのリクエスト（新規登録、編集リンクを踏んだ際のリクエスト）
Route::get('/edit', 'SiteController@edit');
//conf画面の修正リンクを踏んだ場合のリクエスト
Route::post('/edit', 'SiteController@editPos');
//conf画面へのリクエスト
Route::post('/conf', 'SiteController@conf');
Route::post('/done', 'SiteController@done');
Route::post('/delete', 'SiteController@delete');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
