<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'contents',
        'user_post_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function user_like()
    {
        return $this->hasOne(UserCommentLike::class)->where('user_id', auth()->user()->id);
    }

    public function likes()
    {
        return $this->hasMany(UserCommentLike::class)->where('type', 'liked');
    }

    public function dislikes()
    {
        return $this->hasMany(UserCommentLike::class)->where('type', 'disliked');
    }

    public function post()
    {
        return $this->belongsTo(UserPost::class);
    }
}
