<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    //
    public function home()
    {
        return view('admin.article.home');  //検索条件入力画面
    }
    
    
    public function index()
    {
        return view('admin.article.index');
    }
   
    
}