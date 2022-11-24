<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'contents',
        'media_type',
        'media_type_src',
        'visibility',
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function user_like()
    {
        return $this->hasOne(UserLike::class)->where('user_id', auth()->user()->id);
    }

    public function likes()
    {
        return $this->hasMany(UserLike::class)->where('type', 'liked');
    }

    public function dislikes()
    {
        return $this->hasMany(UserLike::class)->where('type', 'disliked');
    }

    public function comments()
    {
        return $this->hasMany(UserComment::class);
    }

    public function user_saved()
    {
        return $this->hasOne(SavedPost::class)->where('user_id', auth()->user()->id);
    }
}
