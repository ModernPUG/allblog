<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title',
        'link',
        'description',
        'blog_id'
    ];

    public function blog()
    {
        return $this->belongsTo('App\Blog');
    }

    public static function makeArticleLink($article)
    {
        $uri = new \App\Uri();
        return $uri->getHost($article->blog->site_url).$article->link;
    }
}
