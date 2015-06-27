<?php

namespace App\Console\Commands;

use App\Reader\IReader;
use Illuminate\Console\Command;

class CrawlFeed extends Command
{
    protected $name = 'crawlfeed:run';

    protected $description = 'RSS를 긁어온다.';

    public function fire(IReader $reader)
    {
        $reader->updateAllblogs();
    }
}
