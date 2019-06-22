<?php

namespace Marshmallow\HelperFunctions;

use Illuminate\Support\ServiceProvider;
use Symfony\Component\Finder\Finder;

class HelperFunctionsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
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
            ->in(__DIR__ . '/helpers')
            ->name('*.php');

        foreach ($files as $file) {
            require_once $file;
        }
    }
}
