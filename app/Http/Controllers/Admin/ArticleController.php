<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Article; //Model
use App\User;
use App\Comment;
use Illuminate\Support\Facades\Auth;

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
 
        return view('admin.article.home', 
        ['a_name' => $a_name, 'a_time' => $a_time, 'a_number' => $a_number,
    'a_place' => $a_place, 'a_user' => $a_user]);
    
    }

    
    
    public function add()
    {
        return view('admin.article.create');
    }
    
    
    public function create(Request $request)
    {
        //validationを行う
        $this->validate($request, Article::$rules);
        
        $article = new Article;
        $form = $request->all();
        
        //フォームから画像が送信されて来たら、保存して、$news->image_path に画像のパスを保存する
        if (isset($form['image'])) {
            $path = $request->file('image')->store('public/image');
            $article->image_path = basename($path);
        } else{
            $article->image_path = null;
        }
        
        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        //フォームから送信されてきたimageをさくじょする
        unset($form['image']);
        
        //データベースに保存する
        $article->user_id = Auth::id();
        $article->fill($form);
        $article->save();
                
        return view('admin.article.detail', 
        ['article_detail' => $article]);  //作成ボタン押したら記事詳細にアクセスする
    }


    public function index(Request $request)
    {
        $query = Article::query(); //??
        
        $a_name = $request->input('name');
        $a_time = $request->input('time');
        $a_number = $request->input('number');
        $a_place = $request->input('place');
        $a_user = $request->input('user');
        $contents = $request->contents;
        
        if(!empty($a_name)){
            $query->where('name', 'like', '%'.$a_name.'%');
        }
        if(!empty($a_time)){
            $query->where('time', 'like', '%'.$a_time.'%');
        }
        
        $articles = $query->get();

        return view('admin.article.index', 
        ['articles' => $articles, 'a_name' => $a_name, 'a_time' => $a_time,
'a_number' => $a_number, 'a_place' => $a_place, 'a_user' => $a_user]);
    }
    
    
    //     public function index(Request $request)
    // {
    //     $cond_name = $request->cond_name;
    //     if ($cond_name != '') {
    //       // 検索されたら検索結果を取得する
    //       $articles = Article::where('name', $cond_name)->get();
    //   } else {
    //       // それ以外はすべてのデータを取得する
    //       $articles = Article::all();
    //   }      
    //     return view('admin.article.index', 
    //     ['articles' => $articles, 'cond_name' => $cond_name]);
    // }



    public function detail(Request $request)  //一覧の詳細リンクから詳細画面へ飛ぶときにいる　create actionでは最後詳細画面に飛ぶから。
    {
        $article = Article::find($request->id);

        $comments = Comment::where('article_id', $article->id)->get();

        if(empty($article)){
            abort(404);
        }
        return view('admin.article.detail', 
        ['article_detail' => $article, 'comments' => $comments]);
        
    }
 
    
    public function edit(Request $request)
    {
        $article = Article::find($request->id);
        if(empty($article)){
            abort(404);
        }        
        return view('admin.article.edit',
        ['article_form' => $article]);  //遷移図に編集ページがない？作成画面と同じ
    }
    
    
    public function update(Request $request)
    {
      $this->validate($request, Article::$rules);
      
      $article = Article::find($request->id);
      $article_form = $request->all();
      
      if ($request->remove == 'true') {//removeにチェックが入っている
          $article_form['image_path'] = null;
      } elseif ($request->file('image')) {//新しく画像が添付されている
          $path = $request->file('image')->store('public/image');
          $article_form['image_path'] = basename($path);
      } else {
          $article_form['image_path'] = $article->image_path; //画像更新なし
      }

      unset($article_form['image']);
      unset($article_form['remove']);
      unset($article_form['_token']);
      
      $article->fill($article_form)->save();
        return view('admin.article.detail', 
        ['article_detail' => $article]);
    }


    public function delete(Request $request)
    {
        $article = Article::find($request->id);
        
        $article->delete();
        
        return redirect('admin/article/home');
    }
}