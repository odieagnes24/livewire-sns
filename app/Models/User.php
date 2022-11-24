<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'fname',
        'lname',
        'uname',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(UserPost::class);
    }

    public function likes()
    {
        return $this->hasMany(UserLike::class);
    }

    public function commment_likes()
    {
        return $this->hasMany(UserCommentLike::class);
    }

    public function comments()
    {
        return $this->hasMany(UserComment::class);
    }

    public function save_posts()
    {
        return $this->hasMany(SavedPost::class);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_followers', 'followed_id', 'follower_id')->withTimestamps();
    }

    public function followings()
    {
        return $this->belongsToMany(User::class, 'user_followers', 'follower_id', 'followed_id')->withTimestamps();
    }

    public function auth_user_followed()
    {
        return  $this->belongsToMany(User::class, 'user_followers', 'followed_id', 'follower_id')->select(['users.id', 'users.name'])->where('follower_id', auth()->user()->id)->withTimestamps();
    }

    public function notifications()
    {
        return $this->hasMany(UserNotification::class);
    }
}
