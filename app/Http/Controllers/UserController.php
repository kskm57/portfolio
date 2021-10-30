<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User; //Model
use App\Article;
use App\Comment;
use App\Board;
use App\Follower;
use Illuminate\Support\Facades\Auth;//Authクラスを読み込むために必要

class UserController extends Controller
{
    public function show(Request $request)
    {
        if(isset($request->id)){
            $user = User::find($request->id);
        }else{
        $user = Auth::user(); //アクセス者を取得
        }
        
        $all_users = User::all();
        // $articles = Article::where('user_id', $user)->get();//アクセス者の記事を取得
        // $boards = Board::where('user_id', $user)->get();//アクセス者の書き込みを取得

        // $favorites = Favorite::where('user_id', $user->id); ユーザーがしたいいねのidを取得
        // $articles = Article
        
        // $follows_articles = Article::where('user_id', $user->followers->followed_id);
        //'follows_articles'=>$follows_articles
        
        return view('user.show',
            ['user'=>$user, 'all_users'=>$all_users]);
    }
    
    
    
        // フォロー
    public function follow(User $user)
    {
        $follower = auth()->user();
        // フォローしているか
        $is_following = $follower->isFollowing($user->id);
        if(!$is_following) {
            // フォローしていなければフォローする
            $follower->follow($user->id);
            return back();
        }
    }

    // フォロー解除
    public function unfollow(User $user)
    {
        $follower = auth()->user();
        // フォローしているか
        $is_following = $follower->isFollowing($user->id);
        if($is_following) {
            // フォローしていればフォローを解除する
            $follower->unfollow($user->id);
            return back();
        }
    }
}