<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    protected $guarded = array('id');
    
    public static $rules = array(
        
        // 'user_id' => 'required',
        'title'=> 'required',
        'contents' => 'required'
        );
        
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function reply()
    {
        return $this->hasMany('App\Reply');
    }
}
