<?php

namespace Marshmallow\HelperFunctions\Facades;

use Illuminate\Support\Facades\Facade;
use Marshmallow\HelperFunctions\SizeHelper;

class Size extends Facade
{
    protected static function getFacadeAccessor()
    {
        return SizeHelper::class;
    }
}
