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

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){
    
    
    //マイページ
    Route::get('mypage', 'Admin\XXXController@add');    
    
    //記事
    Route::get('article/home', 'Admin\ArticleController@home');    
    Route::get('article/create', 'Admin\ArticleController@add');
    Route::post('article/create', 'Admin\ArticleController@create');
    Route::get('article', 'Admin\ArticleController@index');    
    Route::get('article/edit', 'Admin\ArticleController@edit');
    Route::post('article/edit', 'Admin\ArticleController@update');

    //掲示板
    Route::get('board/create', 'Admin\BoardController@add');
    Route::post('board/create', 'Admin\BoardController@create');
    Route::get('board', 'Admin\BoardController@index');    
    Route::get('board/edit', 'Admin\BoardController@edit');
    Route::post('board/edit', 'Admin\BoardController@update');

    
    //いいね
    
    
    
    
    //フォロー
    
    
});


Auth::routes();

//未設定　貼っただけ 後で編集する
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'NewsController@search');
Route::get('/profile', 'ProfileController@index');