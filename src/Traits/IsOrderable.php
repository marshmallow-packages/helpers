<?php

namespace Marshmallow\HelperFunctions\Traits;

use Illuminate\Database\Eloquent\Builder;

trait IsOrderable
{
	/**
     * Gebruik deze scope zodat de volgorde altijd het
     * zelfde is via: ProductCategory::parents()->ordered()->get();
     */
    public function scopeOrdered(Builder $builder, $direction = 'asc')
    {
        $builder->orderBy('order', $direction);
    }
}
