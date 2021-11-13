<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User; //Model
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    
    public function edit(Request $request)//ユーザーのパスワード編集画面へ
    {
        $user = User::find($request->id);
        if(empty($user)){
            abort(404);
        }        
        return view('admin.user.edit',
        ['user' => $user]);
    }
    
    
    public function update(Request $request)//投稿編集実行
    {
        $this->validate($request, User::$rules);//validationを行う
      
        $user = User::find($request->id);
        $user_form = $request->all();
        
        $user_form['password'] = Hash::make($request['password']);

        unset($user_form['_token']);
      
        $user->fill($user_form)->save();
                            
        return redirect('admin/user/index');  //ユーザー一覧にアクセスする
    }


    public function index(Request $request)
    {
        $all_users = User::all();
        $deleted_users = User::onlyTrashed()->get();
        $id = $request->id;
        
        return view('admin.user.index',['all_users'=>$all_users, 'id'=>$id, 
        'deleted_users'=>$deleted_users]);
    }
    
    
    public function delete(Request $request)
    {
        $user = User::find($request->id);
        
        $user->delete();
        
        return redirect('admin/user/index');
    }
    
    
    public function restore(Request $request)
    {
        $user = User::onlyTrashed()->where('id', $request->id)->restore();//削除済みの要素を復元
        // dd($id);
        return redirect('admin/user/index');
    }
}
