<?php

namespace App\Providers;

use App\Console\Commands\SendSlackBestArticles;
use Illuminate\Support\ServiceProvider;

class ReaderServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../../vendor/modern-pug/feed-reader/views', 'fdrdr');

        $this->publishes([
            __DIR__.'/../../vendor/modern-pug/feed-reader/migrations' => database_path('/migrations/ModernPUG/FeedReader'),
        ]);
    }

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
