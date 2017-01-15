<?php

namespace App\Entities;

use App\Scopes\FilterLocalhost;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Article extends \ModernPUG\FeedReader\Article implements Transformable
{
    use TransformableTrait;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new FilterLocalhost);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function viewcounts()
    {
        return $this->hasMany(ViewCount::class);
    }
}
