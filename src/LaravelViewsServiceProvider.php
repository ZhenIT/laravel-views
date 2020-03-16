<?php

namespace Gustavinho\LaravelViews;

use Gustavinho\LaravelViews\Console\FilterMakeCommand;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class LaravelViewsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $file =  __DIR__ . '/helpers.php';
        if (file_exists($file)) {
            require_once($file);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/blade-views', 'laravel-views');

        $this->publishes([
            __DIR__.'/../public/app.js' => public_path('vendor/laravel-views.js'),
            __DIR__.'/../public/app.css' => public_path('vendor/laravel-views.css'),
        ], 'public');

        if ($this->app->runningInConsole()) {
            $this->commands([
                FilterMakeCommand::class
            ]);
        }
    }
}