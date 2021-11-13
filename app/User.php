<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;//Trait 'App\SoftDeletes'

class User extends Authenticatable
{
    protected $guarded = array('id');
    
    public static $rules = array(
        'name' => 'required',
        'email' => 'required',
        'password' => 'required'
        );
    
    use SoftDeletes;

    protected $dates = ['deleted_at'];//削除した日がわかるように$datesでdeleted_atカラムを作成
    
    
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    

    
    
    public function articles()
    {
        return $this->hasMany('App\Article');

    }
    
    
    public function comments()
    {
        return $this->hasMany('App\Comment');

    }
    
    
    public function boards()
    {
        return $this->hasMany('App\Board');
    }


    public function reply()
    {
        return $this->hasMany('App\Reply');
    }
    
    
    public function favorites()
    {
        return $this->hasMany('App\Favorite');
    }
    
    
    
    
    public function followers()
    {
        return $this->belongsToMany(self::class, 'followers', 'followed_id', 'following_id');
    }

    public function follows()
    {
        return $this->belongsToMany(self::class, 'followers', 'following_id', 'followed_id');
    }
    
    
    // フォローする
    public function follow(Int $user_id) 
    {
        return $this->follows()->attach($user_id);
    }

    // フォロー解除する
    public function unfollow(Int $user_id)
    {
        return $this->follows()->detach($user_id);
    }

    // フォローしているか
    public function isFollowing(Int $user_id) 
    {
        return (boolean) $this->follows()->where('followed_id', $user_id)->first(['id']);
    }

    // フォローされているか
    public function isFollowed(Int $user_id) 
    {
        return (boolean) $this->follows()->where('following_id', $user_id)->first(['id']);
    }
    
    
    
}
