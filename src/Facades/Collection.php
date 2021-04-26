<?php

namespace Marshmallow\HelperFunctions\Facades;

use Illuminate\Support\Facades\Facade;
use Marshmallow\HelperFunctions\CollectionHelper;

class Collection extends Facade
{
    protected static function getFacadeAccessor()
    {
        return CollectionHelper::class;
    }
}
