<?php

namespace App;

use ModernPUG\FeedReader\Article;
use ModernPUG\FeedReader\IReader;
use Zend\Feed\Reader\Reader as ZendReader;
use Wandu\Http\Psr\Uri;
use DB;

class Reader extends \ModernPUG\FeedReader\Reader implements IReader
{
    public function recentUpdatedArticlesByTag($tag = null)
    {
        $articles = Article::with('blog', 'tags');

        if ($tag != 'all') {
            $articles = Article::with('blog')
                ->whereHas('tags', function ($q) use ($tag) {

                    $q->whereIn('name', $tags);
                });
        }

        return $articles->orderBy('published_at', 'desc')->paginate(10);
    }
}
