<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'optional_id',
        'contents',
        'is_seen',
        'is_read',
    ];

    protected $dates = ['created_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
