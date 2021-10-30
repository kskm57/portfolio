<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Reply;//Model
use App\Board;
use App\User;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    public function create(Request $request)//掲示板投稿に対する返信を作成
    {
        //validationを行う
        $this->validate($request, Reply::$rules);
        
        $reply = new Reply;
        $form = $request->all();
        $board = Board::find($request->id);//返信する掲示板投稿を取得
        
        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        
        //データベースに保存する
        $reply->user_id = Auth::id();
        $reply->board_id = $request->id;
        $reply->fill($form);
        $reply->save();
        
        $reply = Reply::where('board_id', $board->id)->get();
                
        return view('board/detail', ['board_detail' => $board, 'replies' => $reply]);
        
    }
    
    
    public function delete(Request $request)//掲示板投稿に対する返信を削除
    {
        $reply = Reply::find($request->id);
        
        $reply->delete();
        
        return redirect(route('board.detail', ['id' => $reply->board->id]));
    }

}
