<?php 

namespace Marshmallow\HelperFunctions\Facades;

/**
 */
class Str extends \Illuminate\Support\Facades\Facade
{
    /**
     * {@inheritDoc}
     */
    protected static function getFacadeAccessor()
    {
        return \Marshmallow\HelperFunctions\Str::class;
    }
}