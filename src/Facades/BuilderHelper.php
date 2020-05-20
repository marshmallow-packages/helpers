<?php 

namespace Marshmallow\HelperFunctions\Facades;

/**
 */
class BuilderHelper extends \Illuminate\Support\Facades\Facade
{
    /**
     * {@inheritDoc}
     */
    protected static function getFacadeAccessor()
    {
        return \Marshmallow\HelperFunctions\BuilderHelper::class;
    }
}