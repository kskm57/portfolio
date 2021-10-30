<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article; //Model
use App\User;
use App\Comment;
use App\Reply;
use App\Favorite;
use Illuminate\Support\Facades\Auth;//Authクラスを読み込むために必要

class ArticleController extends Controller
{
    //
    public function home(Request $request)
    {
        $a_name = $request->title;
        $a_time = $request->time;
        $a_number = $request->number;
        $a_place = $request->place;
        $a_user = $request->user;
        $a_all = $request->user;//エラー回避のため
        
 
        return view('article.home', 
        ['a_name' => $a_name, 'a_time' => $a_time, 'a_number' => $a_number,
    'a_place' => $a_place, 'a_user' => $a_user, 'a_all' => $a_all]);
    
    }
    
    
    public function index(Request $request)//検索結果実行
    {
        $query = Article::query(); //??
        
        $a_name = $request->input('name');
        $a_time = $request->input('time');
        $a_number = $request->input('number');
        $a_place = $request->input('place');
        $a_user = $request->input('user');
        $a_all = $request->input('all');
        $a_order = $request->input('order');//POSTでやるには他のメソッド必要？
        $contents = $request->contents;
        
        //dd($a_time);
        
        $articles= Article::all();
        
        if(!empty($a_name)){
            $query->where('name', 'like', '%'.$a_name.'%');
        }
        if(!empty($a_time)){
            $query->where('time', 'like', '%'.$a_time.'%');
        }
        if(!empty($a_number)){
            $query->where('number', 'like', '%'.$a_number.'%');
        }
        if(!empty($a_place)){
            $query->where('place', 'like', '%'.$a_place.'%');
        }
        if(!empty($a_user)){
            $query->where('user', 'like', '%'.$a_user.'%');
        }
        if(!empty($a_all)){
            $query->where('name', 'like', '%'.$a_all.'%')
            ->orwhere('place', 'like', '%'.$a_all.'%')
            // ->orwhere('user', 'like', '%'.$a_all.'%')
            ->orwhere('contents', 'like', '%'.$a_all.'%');
        }


        //検索結果のソート
        if($a_order==null){
            $articles = $query->withCount('favorites')->get();
        }
        if($a_order=="favorites"){
            $articles = $query->withCount('favorites')->orderBy('favorites_count', 'desc')->get();//いいね数多い順
        }
        if($a_order=="created_at_asc"){
            $articles = $query->withCount('favorites')->orderBy('created_at', 'asc')->get();//登校日が古い順
        }
        if($a_order=="created_at_desc"){
            $articles = $query->withCount('favorites')->orderBy('created_at', 'desc')->get();//登校日が新しい順
        }
        //if(sorted_at==XXXで分岐) selectboxで入力されたvalue値(desc降順,asc昇順)を入力
       // $articles = $query->withCount('favorites')->orderBy('favorites_count', $a_order)->get();
        //$articles = $query->orderBy('created_at', 'desc')->get();
        

        return view('article.index', 
        ['articles' => $articles, 'a_name' => $a_name, 'a_time' => $a_time,
'a_number' => $a_number, 'a_place' => $a_place, 'a_user' => $a_user, 'a_all' => $a_all]);
    }
    
    
    

    public function detail(Request $request)  //検索結果詳細画面
    {
        $article = Article::find($request->id);//リクエストの記事idを持つ記事を代入

        $comments = Comment::where('article_id', $article->id)->get();//記事のidと同じ値をarticle_idカラムに持つコメントを取得

        $favorite = Favorite::where('article_id', $request->id)//リクエストのidの記事についたいいねを取得
                            ->where('user_id', Auth::id())->first();//そのいいねがアクセス者のものなら、データを1取得
                                                                    //viewで$favoriteデータ有無で、いいねしたかしてないか場合分け
                            
        // $sql = "select * from favorites";
        // $sth = $pdo -> query($sql);
        // $count = $sth -> rowCount();
                            
        // dd($sql);
        
        if(empty($article)){
            abort(404);
        }
        
        // if(empty($favorite)){
        //     $favorite == null;
        // }
        //dd($article->time);
        
        return view('article.detail', 
        ['article_detail' => $article, 'comments' => $comments, 'favorite' => $favorite]);
        
    }
 
}