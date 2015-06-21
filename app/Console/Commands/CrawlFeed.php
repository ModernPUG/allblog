<?php namespace App\Console\Commands;

use App\Reader\Article;
use App\Reader\Blog;
use App\Reader\IReader;
use Feed;
use Illuminate\Console\Command;
use Wandu\Http\Uri;

class CrawlFeed extends Command
{
    protected $name = 'crawlfeed:run';

    protected $description = 'RSS를 긁어온다.';

    public function fire(IReader $reader)
    {
        $reader->updateAllblogs();
    }
}
