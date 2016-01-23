<?php

namespace App\Providers;

use App\Console\Commands\SendSlackBestArticles;
use Illuminate\Support\ServiceProvider;

class ReaderServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->bind(
            \ModernPUG\FeedReader\IReader::class,
            \App\Reader::class
        );

        $this->commands(\ModernPUG\FeedReader\CrawlFeed::class);
        $this->commands(SendSlackBestArticles::class);
    }
}
