<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = [
        'user_id', 'posted_at', 'content', 'status', 'attachment',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function responses()
    {
        return $this->hasMany('App\Models\Response');
    }
}
