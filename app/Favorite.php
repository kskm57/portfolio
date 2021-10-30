<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $guarded = array('id');
    
    public static $rules = array(
        
        // 'user_id' => 'required',
        // 'article_id' => 'required'
        );
        
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function article()
    {
        return $this->belongsTo('App\Article');
    }
}
