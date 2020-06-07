<?php

namespace Marshmallow\HelperFunctions\Facades;

use Illuminate\Support\Facades\Facade;
use Marshmallow\HelperFunctions\UserHelper;

class User extends Facade
{
    protected static function getFacadeAccessor()
    {
        return UserHelper::class;
    }
}
