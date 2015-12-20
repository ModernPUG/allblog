<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \App\Repositories\ArticleRepository::class,
            \App\Repositories\ArticleRepositoryEloquent::class
        );

        $this->app->bind(
            \App\Repositories\TagRepository::class,
            \App\Repositories\TagRepositoryEloquent::class
        );
    }
}
