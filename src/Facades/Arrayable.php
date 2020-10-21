<?php

namespace Marshmallow\HelperFunctions\Facades;

use Illuminate\Support\Facades\Facade;
use Marshmallow\HelperFunctions\ArrayHelper;

class Arrayable extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ArrayHelper::class;
    }
}
