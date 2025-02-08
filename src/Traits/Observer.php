<?php

namespace Marshmallow\HelperFunctions\Traits;

trait Observer
{
    public static function bootObserver(): void
    {
        \Marshmallow\HelperFunctions\Observers\ModelObserver::observe(
            self::class
        );
    }

    abstract public static function getObserver(): string;
}
