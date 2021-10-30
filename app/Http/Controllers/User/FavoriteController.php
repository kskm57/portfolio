<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Favorite;
use App\Article; //Model
use App\User;
use Illuminate\Support\Facades\Auth;//Authクラスを読み込むために必要

class FavoriteController extends Controller
{
    //
    public function store(Request $request)
    {
        $form = $request->all();
        unset($form['_token']);
        
        $favorite = new Favorite;
        $favorite->article_id = $request->article_id;
        $favorite->user_id = Auth::id();
        $favorite->save();
        
        return redirect(route('article_detail', ['id' => $request->article_id]));
        
    }
    
    
    public function destroy(Request $request)
    {
        $favorite = Favorite::where('article_id', $request->article_id)
                            ->where('user_id', Auth::id());
        $favorite->delete();
        
        return redirect(route('article_detail', ['id' => $request->article_id]));
        
    }
}
