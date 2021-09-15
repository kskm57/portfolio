<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    //
    public function home()
    {
        return view('admin.article.home');  //検索条件入力画面
    }
    
    
    public function add()
    {
        return view('admin.article.create');
    }
    
    
    public function create()
    {
        return redirect('admin/article/detail');  //作成ボタン押したら記事詳細にアクセスする
    }


    public function index()
    {
        return view('admin.article.index');
    }
   
    
    public function edit()
    {
        return view('admin.article.edit');  //遷移図に編集ページがない？作成画面と同じ
    }
    
    
    public function update()
    {
        return redirect('admin/article/edit');
    }

    public function delete()
    {
        return redirect('admin/article');        
    }
}