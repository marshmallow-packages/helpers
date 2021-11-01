<?php

namespace Marshmallow\HelperFunctions\Facades;

use Illuminate\Support\Facades\Facade;
use Marshmallow\HelperFunctions\CsvHelper;

class CSV extends Facade
{
    protected static function getFacadeAccessor()
    {
        return CsvHelper::class;
    }
}
