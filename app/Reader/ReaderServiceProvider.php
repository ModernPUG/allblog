<?php namespace App\Reader;

use Illuminate\Support\ServiceProvider;

class ReaderServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
        $this->app->singleton(\App\Reader\IReader::class, function ($app) {
            return new \App\Reader\Reader();
        });
	}

}
