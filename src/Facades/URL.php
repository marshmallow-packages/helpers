<?php 

namespace Marshmallow\HelperFunctions\Facades;

class URL extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor()
    {
        return \Marshmallow\HelperFunctions\URL::class;
    }
}