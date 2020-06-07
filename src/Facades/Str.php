<?php

namespace Marshmallow\HelperFunctions\Facades;

use Illuminate\Support\Facades\Facade;
use Marshmallow\HelperFunctions\StrHelper;

class Str extends Facade
{
    protected static function getFacadeAccessor()
    {
        return StrHelper::class;
    }
}
