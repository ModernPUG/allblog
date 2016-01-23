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

    public function getLastBestArticlesByTags($lastDays, $tagIds)
    {
        $tagCondition ='';
        if($tagIds) {
            $tagIdsString = join(',', $tagIds);
            $tagCondition = " AND article_tag.tag_id IN ($tagIdsString) ";
        }

        $sql =<<<SQL
SELECT count(articles.id) AS vcount, articles.*
FROM viewcount
JOIN articles
ON articles.id = viewcount.article_id
JOIN article_tag
ON articles.id = article_tag.article_id
WHERE viewcount.created_at >= DATE(NOW()) - INTERVAL ? DAY
$tagCondition
GROUP BY articles.id
ORDER BY vcount DESC
LIMIT 20
SQL;
        $result = DB::select($sql, [$lastDays]);
        return Article::hydrate($result);
    }
}
