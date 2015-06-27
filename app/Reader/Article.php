<?php

namespace App\Reader;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title',
        'link',
        'description',
        'published_at',
        'blog_id',
    ];

    public function blog()
    {
        return $this->belongsTo('App\Reader\Blog');
    }

    public function Tags()
    {
        return $this->belongsToMany('App\Reader\Tag');
    }
}
