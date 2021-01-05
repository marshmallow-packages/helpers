<?php

namespace Marshmallow\HelperFunctions\Facades;

use Illuminate\Support\Facades\Facade;
use Marshmallow\HelperFunctions\NumberHelper;

class Number extends Facade
{
    protected static function getFacadeAccessor()
    {
        return NumberHelper::class;
    }
}
