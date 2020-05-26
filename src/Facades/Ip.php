<?php

namespace Marshmallow\HelperFunctions\Facades;

/**
 */
class Ip extends \Illuminate\Support\Facades\Facade
{
    /**
     * {@inheritDoc}
     */
    protected static function getFacadeAccessor()
    {
        return \Marshmallow\HelperFunctions\Ip::class;
    }
}
