<?php

namespace Marshmallow\HelperFunctions;

use Symfony\Component\Finder\Finder;
use Illuminate\Support\ServiceProvider;

class HelperFunctionsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Str::class, function ($app) {
            return new Str;
        });

        $this->app->singleton(URL::class, function ($app) {
            return new URL;
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
