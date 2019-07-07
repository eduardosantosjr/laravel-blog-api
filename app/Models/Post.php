<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\FullTextSearch;

class Post extends Model
{
    use FullTextSearch;
    
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'published',
        'published_at',
    ];

    protected $searchable = [
        'title',
        'content',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
