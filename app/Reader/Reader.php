<?php

namespace App\Reader;

class Reader implements IReader
{
    private $lastError;

    public function getLastError()
    {
        return $this->lastError;
    }

    public function recentUpdatedArticles()
    {
        return Article::with('blog')->orderBy('created_at', 'desc')->paginate(10);
    }

    public function blogs()
    {
        return Blog::orderBy('title', 'asc')->get();
    }

    public function insertFeed($hostUrl, $feedUrl, $type)
    {
        if (empty($feedUrl)) {
            $this->lastError = '누락된 값이 있습니다.';
            return false;
        }

        try {
            $uri = new \App\Reader\Uri();
            $feedUrl = $uri->attachSchemeIfNotExist($feedUrl);

            $feed = new \Feed();
            switch ($type) {
                case 'atom' :
                    $feed = $feed->loadAtom($feedUrl);
                    break;
                default :
                    $feed = $feed->loadRss($feedUrl);
                    break;
            }

            // site url 과 feed url 이 다를 경우가 있으므로 hostUrl 을 전송했으면 그 값 사용
            if (empty($hostUrl)) {
                $hostUrl = $uri->getScheme($feedUrl) . '://' . $uri->getHost($feedUrl);
            }
            $hostUrl = $uri->attachSchemeIfNotExist($hostUrl);

            $blog = new Blog();
            $blog->title = $feed->title;
            $blog->site_url = $hostUrl;
            $blog->feed_url = $feedUrl;
            $blog->type = $type;
            $blog->save();

            \Artisan::call('crawlfeed:run');

        } catch (QueryException $e) {

            $this->lastError = "데이터베이스 오류입니다.";
            if ($e->getCode() === '23000') {
                $this->lastError = "중복된 url이거나 title입니다";
            }
            return false;

        } catch (\Exception $e) {

            if ($e->getMessage() == 'String could not be parsed as XML') {
                $this->lastError = '부적합한 RSS 주소 입니다.';
            } else {
                \Log::error($e);
                $this->lastError = '알 수 없는 예외 발생.';
            }
            return false;

        }

        return true;
    }
}