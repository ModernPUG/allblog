<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Wandu\Http\Uri;

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
        $uri = new Uri($article->blog->host);

        return $uri->getHost().$article->link;
    }
}
