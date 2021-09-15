<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BoardController extends Controller
{
    //
    public function add()
    {
        return view('admin.board.create');
    }
    
    
    public function create()
    {
        return redirect('admin/aboard/detail');  //作成ボタン押したら記事詳細にアクセスする
    }


    public function index()
    {
        return view('admin.board.index');
    }
   
    
    public function edit()
    {
        return view('admin.board.edit');  //遷移図に編集ページがない？作成画面と同じ
    }
    
    
    public function update()
    {
        return redirect('admin/board/edit');
    }

    public function delete()
    {
        return redirect('admin/board');        
    }
    
}
