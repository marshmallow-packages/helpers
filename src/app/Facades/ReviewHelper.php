<?php 

namespace Marshmallow\HelperFunctions\Facades;

/**
 */
class ReviewHelper extends \Illuminate\Support\Facades\Facade
{
    /**
     * {@inheritDoc}
     */
    protected static function getFacadeAccessor()
    {
        return \Marshmallow\HelperFunctions\ReviewHelper::class;
    }
}