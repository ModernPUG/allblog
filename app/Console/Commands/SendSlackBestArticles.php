<?php

namespace App\Console\Commands;

use App\Entities\Tag;
use Illuminate\Console\Command;
use ModernPUG\FeedReader\IReader;

class SendSlackBestArticles extends Command
{
    protected $name = 'send:slack:best';

    protected $description = 'Slack에 인기글을 보낸다';

    public function fire(IReader $reader, Tag $tag)
    {
        $phpTagIds = [];
        $phpTagCollection = $tag->getPhpTagCollection();
        foreach($phpTagCollection as $phpTag) {
            $phpTagIds[] = $phpTag['id'];
        }

        $articles = $reader->getLastBestArticlesByTag(7, $phpTagIds);
        $rank = 1;
        $output = "allblog 주간 인기글 입니다. \r\n\r\n";
        foreach ($articles as $article) {
            $url = url("article/{$article->id}");
            $title = $article->title;
            $output .= "$rank. $title ( $url )\r\n\r\n";
            $rank++;
        }

        \Slack::send($output);
    }
}
