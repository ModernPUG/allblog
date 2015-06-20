<?php

namespace App;

use Illuminate\Http\Request;
use Feed;
use Artisan;

class Reader
{
    public function recentUpdatedArticles()
    {
        return Article::with('blog')->orderBy('created_at', 'desc')->paginate(10);
    }

    public function blogs()
    {
        return Blog::orderBy('title', 'asc')->get();
    }

    public function insertFeed(Request $request)
    {
        $blog = new Blog();
        $feed = new Feed();
        $uri = new \App\Uri();

        $feedUrl = $request->input('feed_url');
        $type = $request->input('type');

        if (empty($feedUrl)) {
            return redirect('/blog')->with('message', '누락된 값이 있습니다.');
        }

        $feedUrl = $uri->attachSchemeIfNotExist($feedUrl);

        try {
            switch ($type) {
                case 'atom' :
                    $feed = $feed->loadAtom($feedUrl);
                    break;
                default :
                    $feed = $feed->loadRss($feedUrl);
                    break;
            }

            $blog->title = $feed->title;

            // site url 과 feed url 이 다를 경우가 있으므로 hostUrl 을 전송했으면 그 값 사용
            $hostUrl = $request->input('site_url');
            if (empty($hostUrl)) {
                $hostUrl = $uri->getScheme($feedUrl) . '://' . $uri->getHost($feedUrl);
            }

            $hostUrl = $uri->attachSchemeIfNotExist($hostUrl);

            $blog->site_url = $hostUrl;
            $blog->feed_url = $feedUrl;
            $blog->type = $type;

            $blog->save();
            Artisan::call('crawlfeed:run');
        } catch (QueryException $e) {
            $message = "데이터베이스 오류입니다.";

            if ($e->getCode() === '23000') {
                $message = "중복된 url이거나 title입니다";
            }

            return redirect('/blog')->with('message', $message);
        } catch (\Exception $e) {
            if ($e->getMessage() == 'String could not be parsed as XML') {
                return redirect('/blog')->with('message', '부적합한 RSS 주소 입니다.');
            } else {
                \Log::error($e);
                return redirect('/blog')->with('message', '알 수 없는 예외 발생.');
            }
        }

        return redirect('/blog');
    }
}