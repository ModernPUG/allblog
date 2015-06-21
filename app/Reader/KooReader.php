<?php

namespace App\Reader;

use Zend\Feed\Reader\Reader as ZendReader;

class KooReader extends Reader implements IReader
{
    public function getCreateViewName()
    {
        return "blogs.koocreate";
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
            $blog->create($blogInfo);
            \Artisan::call('crawlfeed:run'); //TODO: atom feed가 자꾸 invalid channel 오류가 나는데 atom url 만드는 법은 배워서 해야징

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

            //TODO: 아놔 get_class 썼음.. DB에게 type을 알려줘야 스케쥴러가 돌수 있기 때문인데 나중에 스케쥴러 zend로 바꾸면서 없애자
            $feed = ZendReader::import($url);
            $type = '';
            switch ( get_class($feed) ) {
                case 'Zend\Feed\Reader\Feed\Rss':
                    $type = 'rss';
                    break;
                case 'Zend\Feed\Reader\Feed\Atom':
                    $type = 'atom';
                    break;
                default:
                    return null;
                    break;
            }
            $feedUrl = $feed->getFeedLink();
            $siteUrl = $feed->getLink();
            if (!strpos($siteUrl, '://')) {
                $uri = new \App\Reader\Uri();
                $siteUrl = $uri->getScheme($feedUrl) . '://' . $uri->getHost($feedUrl) . $siteUrl;
            }
            $blogInfo = [
                'title' => $feed->getTitle(),
                'feed_url' => $feedUrl,
                'site_url' => $siteUrl,
                'type' => $type,
            ];

        } catch ( \Exception $e ) {
            return null;
        }

        return $blogInfo;
    }
}