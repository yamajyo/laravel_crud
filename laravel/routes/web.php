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

Route::get('/test', 'TestController@test');
Route::post('/test', 'TestController@testPos');
Route::get('/top', 'TestController@top');
Route::get('/logout', 'TestController@logout');
Route::get('/list', 'SiteController@list');
Route::get('/edit', 'SiteController@edit');
Route::post('/edit', 'SiteController@editPos');
Route::post('/conf', 'SiteController@conf');
Route::post('/done', 'SiteController@done');
Route::get('/e', 'SiteController@test');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
