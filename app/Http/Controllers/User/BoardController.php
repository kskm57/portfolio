<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Board;
use App\User;
use App\Reply;
use Illuminate\Support\Facades\Auth;//Authクラスを読み込むために必要

class BoardController extends Controller
{
    //
    public function add()//掲示板投稿作成画面へ
    {
        return view('board.create');
    }
    
    
    public function create(Request $request)//掲示板投稿作成
    {
        $this->validate($request, Board::$rules);
        
        $board = new Board;
        $form = $request->all();
        $reply = Reply::where('board_id', $board->id)->get();//掲示板についたコメントを取得
        
        unset($form['_token']);
        
        $board->user_id = Auth::id();
        $board->fill($form);
        $board->save();
        
        return redirect(route('board.detail', ['id' => $board->id]));  //作成ボタン押したら記事詳細にアクセスする
    }


    public function index(Request $request)//掲示板投稿一覧
    {
        $boards = Board::all();
        
        return view('board.index', ['boards' => $boards]);
    }
    
    
    public function detail(Request $request)//掲示板投稿詳細    
    {
        $board = Board::find($request->id);
        
        $reply = Reply::where('board_id', $board->id)->get();
        
        return view('board.detail', ['board_detail' => $board, 'replies' => $reply]);
    }
   
    
    public function edit(Request $request)//掲示板投稿編集画面へ
    {
        $board = Board::find($request->id);
        if(empty($board)){
            abort(404);
        }
        
        return view('board.edit', ['board_form' => $board]);
    }
    
    
    public function update(Request $request)//掲示板投稿編集実行
    {
        $this->validate($request, Board::$rules);
        
        $board = Board::find($request->id);
        $board_form = $request->all();
        
        unset($board_form['_token']);
        
        $board->fill($board_form)->save();
        
        $reply = Reply::where('board_id', $board->id)->get();//掲示板についたコメントを取得
        
        return view('board.detail', ['board_detail' => $board, 'replies' => $reply]);
    }


    public function delete(Request $request)//掲示板投稿削除
    {
        $board = Board::find($request->id);
        
        $board -> delete();
        
        return redirect('user/board');
    }
    
}
