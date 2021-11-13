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

// Route::get('/', function () {
//     return view('welcome');
// });

//Adminログイン後
Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function(){
    
    Route::get('user/edit', 'Admin\UserController@edit');//ユーザーパスワード編集画面
    Route::post('user/update', 'Admin\UserController@update');//ユーザーパスワード編集
    Route::get('user/index', 'Admin\UserController@index');//ユーザー一覧
    Route::get('user/delete', 'Admin\UserController@delete');//ユーザー削除
    Route::get('user/restore', 'Admin\UserController@restore');//ユーザー復元
    
});


//Adminログイン前
Route::group(['prefix' => 'admin'], function() {
    Route::get('/',         function () { return redirect('/admin/user/index'); });
    Route::get('login',     'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login',    'Admin\LoginController@login');
    
});


//ユーザーログイン後
Route::group(['prefix' => 'user', 'middleware' => 'auth:user'], function(){
    
    //記事
    // Route::get('article/home', 'Admin\ArticleController@home');    //検索条件入力画面
    Route::get('article/create', 'User\ArticleController@add');
    Route::post('article/create', 'User\ArticleController@create');
    Route::get('article/edit', 'User\ArticleController@edit');
    Route::post('article/edit', 'User\ArticleController@update');
    Route::get('article/delete', 'User\ArticleController@delete');
    
    //コメント
    Route::post('article/detail', 'User\CommentController@create');
    Route::get('article/comment/delete', 'User\CommentController@delete');
    
    //掲示板
    Route::get('board/create', 'User\BoardController@add');
    Route::post('board/create', 'User\BoardController@create');
    Route::get('board', 'User\BoardController@index');
    Route::get('board/detail', 'User\BoardController@detail')->name('board.detail');
    Route::get('board/edit', 'User\BoardController@edit');
    Route::post('board/edit', 'User\BoardController@update');
    Route::get('board/delete', 'User\BoardController@delete');
    
    //返信
    Route::post('board/detail', 'User\ReplyController@create');
    Route::get('board/reply/delete', 'User\ReplyController@delete');

    
    //いいね
    Route::post('favorite/destroy', 'User\FavoriteController@destroy');
    Route::post('favorite/store', 'User\FavoriteController@store');
    
    
    //フォロー
    Route::post('users/{user}/follow', 'UserController@follow')->name('follow');
    Route::delete('users/{user}/unfollow', 'UserController@unfollow')->name('unfollow');    
    
});


Auth::routes();


Route::get('user', 'UserController@show')->name('user');//ユーザーページ


Route::get('/home', 'HomeController@index')->name('home');//ログイン後の画面


Route::get('/', 'ArticleController@home')->name('top');//検索画面
Route::get('/index', 'ArticleController@index');//検索結果表示画面

//記事
Route::get('article/detail', 'ArticleController@detail')->name('article_detail');//記事詳細画面

// Route::post('/index/order', 'ArticleController@index');
// Route::get('/welcome', 'XXXController@index');
//Route::get('/', 'BoardController@index');