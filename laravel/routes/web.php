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
//indexへのリクエスト
Route::get('/', 'PostController@index')->name('index');
//edit画面へのリクエスト（新規登録の際のリクエスト）
Route::get('/edit', 'PostController@edit')->name('edit');
//conf画面の修正リンクを踏んだ場合かlistページの編集のリンクを踏んだ時のリクエスト
Route::post('/edit', 'PostController@editPos')->name('edit');
//conf画面へのリクエスト
Route::post('/conf', 'PostController@conf')->name('conf');
//done画面へのリクエスト
Route::post('/done', 'PostController@done')->name('done');
//listページの削除ボタンを踏んだ際のリクエスト
Route::post('/delete', 'PostController@delete')->name('delete');
