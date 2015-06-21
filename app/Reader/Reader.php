<?php

namespace App\Reader;

use Zend\Feed\Reader\Reader as ZendReader;
use Wandu\Http\Uri;

class Reader implements IReader
{
    protected $lastError;

    public function getLastError()
    {
        return $this->lastError;
    }

    public function getCreateViewName()
    {
        return "blogs.create";
    }

    public function recentUpdatedArticles()
    {
        return Article::with('blog')->orderBy('created_at', 'desc')->paginate(10);
    }

    public function blogs()
    {
        return Blog::orderBy('title', 'asc')->get();
    }

    public function insertFeed($args)
    {
        $url = $args['url'];

        if (empty($url)) {
            $this->lastError = '누락된 값이 있습니다.';
            return false;
        }

        try {
            $blogInfo = $this->getBlogInfo($url);
            if ( ! $blogInfo ) {
                foreach ( ZendReader::findFeedLinks($url) as $link ) {
                    $url = $link['href'];
                    break;
                }
                $blogInfo = $this->getBlogInfo($url);
            }
            $blog = new Blog();
            $blog = $blog->create($blogInfo);
            $this->updateBlog($blog);

        } catch ( \Exception $e ) {
            $this->lastError = $e->getMessage();
            return false;
        }

        return true;
    }

    private function getBlogInfo($url)
    {
        $blogInfo = null;

        try {
            $feed = ZendReader::import($url);

            $feedUrl = $feed->getFeedLink();
            if (!strpos($feedUrl, '://')) {
                $uri = new Uri($url);
                $feedUrl = $uri->getScheme() . '://' . $uri->getHost().$feedUrl;
            }

            $uri = new Uri($feedUrl);
            $siteUrl = $uri->getScheme().'://'.$uri->getHost();

            $blogInfo = [
                'title' => $feed->getTitle(),
                'feed_url' => $feedUrl,
                'site_url' => $siteUrl
            ];

        } catch ( \Exception $e ) {
            return null;
        }

        return $blogInfo;
    }

    public function updateAllblogs()
    {
        $blogs = $this->blogs();

        foreach($blogs as $blog)
        {
            $this->updateBlog($blog);
        }
    }

    public function updateBlog($blog)
    {
        $feed = ZendReader::import($blog->feed_url);

        foreach($feed as $entry)
        {
            $blogUri = new Uri($blog->feed_url);
            $articleUri = new Uri($entry->getLink());
            $link = $blogUri->join($articleUri)->__toString();
            $description = $entry->getDescription();

            $article = Article::where('blog_id', $blog->id)
                ->where('link', $link)
                ->first();

            if (empty($article)) {
                Article::create([
                    'title'       => $entry->getTitle(),
                    'link'        => $link,
                    'description' => $description,
                    'blog_id'     => $blog->id
                ]);
            } else {
                if($article->title != $entry->getTitle() || $article->description != $description ) {
                    $article->title = $entry->getTitle();
                    $article->description = $description;
                    $article->save();
                }
            }
        }
    }
}