<?php

namespace Marshmallow\HelperFunctions;

use Symfony\Component\Finder\Finder;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(StrHelper::class, function ($app) {
            return new StrHelper;
        });

        $this->app->singleton(UrlHelper::class, function ($app) {
            return new UrlHelper;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $files = Finder::create()
            ->files()
            ->in(__DIR__ . '/HelperFunctions')
            ->name('*.php');

        foreach ($files as $file) {
            require_once $file;
        }
    }
}
