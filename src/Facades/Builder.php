<?php

namespace Marshmallow\HelperFunctions\Facades;

use Illuminate\Support\Facades\Facade;
use Marshmallow\HelperFunctions\BuilderHelper;

class Builder extends Facade
{
    protected static function getFacadeAccessor()
    {
        return BuilderHelper::class;
    }
}
