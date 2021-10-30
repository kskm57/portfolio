<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Comment;//Model
use App\Article;
use App\User;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function create(Request $request)//投稿記事に対するコメントを作成
    {
        //validationを行う
        $this->validate($request, Comment::$rules);
        
        $comment = new Comment;
        $form = $request->all();
        
        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        
        //データベースに保存する
        $comment->user_id = Auth::id();//user_idカラムにはアクセス者のidを代入
        $comment->article_id = $request->id;//article_idカラムにはリクエストのidを代入
        $comment->fill($form);
        $comment->save();
                
        return redirect()->back();
        
    }
    
    
    // public function index(Request $request)//いらいない
    // {
    //     $articles = Article::all();
          
    //     return view('admin.article.detail', 
    //     ['articles' => $articles, 'cond_name' => $cond_name]);
    // }
    
    
    public function delete(Request $request)//投稿記事に対するコメントを削除
    {
        $comment = Comment::find($request->id);
        
        $comment->delete();
        
        return redirect()->back();
    }

}
