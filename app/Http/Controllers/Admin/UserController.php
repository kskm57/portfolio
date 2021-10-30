<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User; //Model

class UserController extends Controller
{
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
