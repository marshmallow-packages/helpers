<?php

namespace Marshmallow\HelperFunctions\Facades;

use Illuminate\Support\Facades\Facade;
use Marshmallow\HelperFunctions\ReviewHelper;

class Review extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ReviewHelper::class;
    }
}
