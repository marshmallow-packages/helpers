<?php

namespace Marshmallow\HelperFunctions\Facades;

use Illuminate\Support\Facades\Facade;
use Marshmallow\HelperFunctions\UrlHelper;

class URL extends Facade
{
    protected static function getFacadeAccessor()
    {
        return UrlHelper::class;
    }
}
