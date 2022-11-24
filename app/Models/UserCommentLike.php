<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCommentLike extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'user_comment_id',
        'type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function comment()
    {
        return $this->belongsTo(UserComment::class);
    }
}
