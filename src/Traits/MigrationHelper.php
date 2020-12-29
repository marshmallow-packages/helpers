<?php

namespace Marshmallow\HelperFunctions\Traits;

use Illuminate\Support\Facades\Schema;

trait MigrationHelper
{
    protected function createColumnIfDoesntExist($table, $column, $callback)
    {
        if (! Schema::hasColumn($table, $column)) {
            Schema::table($table, $callback);
        }
    }
}
