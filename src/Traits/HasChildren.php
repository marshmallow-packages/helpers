<?php

namespace Marshmallow\HelperFunctions\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasChildren
{
	/**
     * Gebruik deze scope om de top level categorien
     * op te halen via: ProductCategory::parents()->ordered()->get();
     */
    public function scopeParents(Builder $builder)
    {
        $builder->whereNull('parent_id');
    }
}
