<?php

namespace Marshmallow\HelperFunctions\Facades;

/**
 */
class Date extends \Illuminate\Support\Facades\Facade
{
    /**
     * {@inheritDoc}
     */
    protected static function getFacadeAccessor()
    {
        return \Marshmallow\HelperFunctions\Date::class;
    }
}
