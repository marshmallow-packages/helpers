<?php

namespace Marshmallow\HelperFunctions;

abstract class NovaRelationshipHelper
{
    public static function withPivot(): array
    {
        return [
            //
        ];
    }

    abstract public static function fields(): array;
}
