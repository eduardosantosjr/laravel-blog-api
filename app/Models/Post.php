<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'published',
        'published_at',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
