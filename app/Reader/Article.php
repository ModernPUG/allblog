<?php namespace App\Reader;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title',
        'link',
        'description',
        'published_at',
        'blog_id'
    ];

    public function blog()
    {
        return $this->belongsTo('App\Reader\Blog');
    }

    public static function makeArticleLink($article)
    {
        $uri = new \App\Reader\Uri();
        return $uri->getHost($article->blog->site_url).$article->link;
    }
}
