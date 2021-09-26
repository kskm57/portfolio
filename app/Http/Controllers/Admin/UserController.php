<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User; //Model
use App\Article;
use App\Comment;

class UserController extends Controller
{
    public function add(Request $request)
    {
        $user = User::find($request->id); //アクセス者のidを取得
        // $posts = Article::where('user_id', $user)->get();アクセス者の記事を取得
        $articles = $user->articles;
        return view('admin.user.index',
            ['articles' => $articles]);
    }
}