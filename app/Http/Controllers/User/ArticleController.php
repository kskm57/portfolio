<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Article; //Model
use App\User;
use App\Comment;
use App\Reply;
use App\Favorite;
use Illuminate\Support\Facades\Auth;//Authクラスを読み込むために必要
use Storage;//imageの保存をS3になるように

class ArticleController extends Controller
{
    //
    public function home(Request $request)
    {
        $params = [];
        $params['name'] = $request->title;
        $params['time'] = $request->time;
        $params['number'] = $request->number;
        $params['place'] = $request->place;
        $params['user'] = $request->user;
        $params['all'] = $request->all;
        // $a_name = $request->title;
        // $a_time = $request->time;
        // $a_number = $request->number;
        // $a_place = $request->place;
        // $a_user = $request->user;
        // $a_all = $request->all;
        
        dd($params);
            
        return view('article.home', compact('params'));
        // return view('admin.article.home', compact('test', 'a_name', 'a_time', 'a_number', 
        //     'a_place', 'a_all', 'a_user'));
    //     ['a_name' => $a_name, 'a_time' => $a_time, 'a_number' => $a_number,
    // 'a_place' => $a_place, 'a_user' => $a_user, 'all' => $all]);
    
    }

    
    
    public function add()//新規投稿作成画面へ
    {
        return view('article.create');
    }
    
    
    public function create(Request $request)//作成した投稿データを送信
    {
        //validationを行う
        $this->validate($request, Article::$rules);
        
        $article = new Article;//インスタンス化(投稿データを格納するレコードを作成)
        $comments = Comment::where('article_id', $article->id);//この投稿についたコメントを取得
        $form = $request->all();
        
        //フォームから画像が送信されて来たら、保存して、$news->image_path に画像のパスを保存する
        if (isset($form['image'])) {
            $path = Storage::disk('s3')->putFile('/',$form['image'],'public');
            $article->image_path = Storage::disk('s3')->url($path);
            
        } else{
            $article->image_path = null;
        }
        
        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        //フォームから送信されてきたimageをさくじょする
        unset($form['image']);
        
        //dd($request->time);
        
        //データベースに保存する
        $article->user_id = Auth::id();
        $article->fill($form);
        $article->save();
                
        return redirect(route('article_detail', ['id' => $article->id]));  //作成ボタン押したら記事詳細にアクセスする
    }


//     public function index(Request $request)//検索実行
//     {
//         $query = Article::query(); //??
        
//         $a_name = $request->input('name');
//         $a_time = $request->input('time');
//         $a_number = $request->input('number');
//         $a_place = $request->input('place');
//         $a_user = $request->input('user');
//         $a_all = $request->input('all');
//         $contents = $request->contents;
        
//         if(!empty($a_name)){
//             $query->where('name', 'like', '%'.$a_name.'%');
//         }
//         if(!empty($a_time)){
//             $query->where('time', 'like', '%'.$a_time.'%');
//         }
//         if(!empty($a_number)){
//             $query->where('number', 'like', '%'.$a_number.'%');
//         }
//         if(!empty($a_place)){
//             $query->where('place', 'like', '%'.$a_place.'%');
//         }
//         if(!empty($a_user)){
//             $query->where('user', 'like', '%'.$a_user.'%');
//         }
        
//         $articles = $query->get();

//         return view('article.index', 
//         ['articles' => $articles, 'a_name' => $a_name, 'a_time' => $a_time,
// 'a_number' => $a_number, 'a_place' => $a_place, 'a_user' => $a_user]);
//     }
    
    
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



    
    public function edit(Request $request)//投稿の編集画面へ
    {
        $article = Article::find($request->id);
        if(empty($article)){
            abort(404);
        }        
        return view('article.edit',
        ['article_form' => $article]);
    }
    
    
    public function update(Request $request)//投稿編集実行
    {
        $this->validate($request, Article::$rules);//validationを行う
      
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
      
        $comments = Comment::where('article_id', $article->id)->get();//記事のidと同じ値をarticle_idカラムに持つコメントを取得

        $favorite = Favorite::where('article_id', $request->id)//リクエストのidの記事についたいいねを取得
                            ->where('user_id', Auth::id())->first();//そのいいねがアクセス者のものなら、データを1取得
                                                                    //viewで$favoriteデータ有無で、いいねしたかしてないか場合分け
                            
                            
        return redirect(route('article_detail', ['id' => $article->id]));  //記事詳細にアクセスする
    }


    public function delete(Request $request)
    {
        $article = Article::find($request->id);
        
        $article->delete();
        
        return redirect(route('user', ['id' => $article->user]));//記事作成者のユーザーページへ
    }
}