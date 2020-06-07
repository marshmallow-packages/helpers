<?php

namespace Marshmallow\HelperFunctions\Facades;

use Illuminate\Support\Facades\Facade;
use Marshmallow\HelperFunctions\IpHelper;

class Ip extends Facade
{
    protected static function getFacadeAccessor()
    {
        return IpHelper::class;
    }
}
