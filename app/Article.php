<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $guarded = array('id');
    
    public static $rules = array(

        'name' => 'required',
        'time' => 'required',
        'number' => 'required',
        'place' => 'required',
        'contents' => 'required'
        );
        
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    
    public function comments()
    {
        return $this->hasMany('App\Comment');

    }
}
