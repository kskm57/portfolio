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
    Route::get('user', 'Admin\UserController@add');    
    
    //記事
    Route::get('article/home', 'Admin\ArticleController@home');    //検索条件入力画面
    Route::get('article/create', 'Admin\ArticleController@add');
    Route::post('article/create', 'Admin\ArticleController@create');
    Route::get('article', 'Admin\ArticleController@index');
    Route::get('article/detail', 'Admin\ArticleController@detail');    
    Route::get('article/edit', 'Admin\ArticleController@edit');
    Route::post('article/edit', 'Admin\ArticleController@update');
    Route::get('article/delete', 'Admin\ArticleController@delete');
    
    //コメント
    Route::post('article/detail', 'Admin\CommentController@create');
    Route::get('article/comment/delete', 'Admin\CommentController@delete');
    
    //掲示板
    Route::get('board/create', 'Admin\BoardController@add');
    Route::post('board/create', 'Admin\BoardController@create');
    Route::get('board', 'Admin\BoardController@index');
    Route::get('board/detail', 'Admin\BoardController@detail');
    Route::get('board/edit', 'Admin\BoardController@edit');
    Route::post('board/edit', 'Admin\BoardController@update');

    
    //いいね
    
    
    
    
    //フォロー
    
    
});


Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'ArticleController@home');
//Route::get('/', 'BoardController@index');

