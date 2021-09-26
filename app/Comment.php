<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = array('id');
    
    public static $rules = array(
        'contents' => 'required'
        );
     
        
    public function user(){
        return $this->belongsTo('App\User');
    }
    
    public function article(){
        return $this->belongsTo('App\Article');
    }
}
