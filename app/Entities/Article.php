<?php

namespace App\Entities;

use Illuminate\Support\Facades\Log;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Article extends \ModernPUG\FeedReader\Article implements Transformable
{
    use TransformableTrait;

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function viewcounts()
    {
        return $this->hasMany(ViewCount::class);
    }
}
