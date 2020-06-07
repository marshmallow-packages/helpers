<?php

namespace Marshmallow\HelperFunctions\Facades;

use Illuminate\Support\Facades\Facade;
use Marshmallow\HelperFunctions\DateHelper;

class Date extends Facade
{
    protected static function getFacadeAccessor()
    {
        return DateHelper::class;
    }
}
