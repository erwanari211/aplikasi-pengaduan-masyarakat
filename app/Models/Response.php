<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    protected $fillable = [
        'user_id', 'feedback_id', 'posted_at', 'content', 'status',
    ];
}
