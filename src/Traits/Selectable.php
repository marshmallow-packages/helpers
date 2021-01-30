<?php

namespace Marshmallow\HelperFunctions\Traits;

use Closure;

trait Selectable
{
    /**
     * This method will return an array that can be used
     * in a Nova Resource to select an option. You can
     * use this like so:
     * 
     * Select::make(__('Product'), 'product')->options(Product::options());
     * 
     * Product::options('id', 'name', function ($query) {
     * $query->where('product_category_id', 8);
     * }, function ($product) {
     * 	$product->name = $product->fullname();
     *   	return $product;
     * });
     * 
     * 
     * 
     */
    public static function options ($key = 'id', $value = 'name', Closure $where = null, Closure $map = null)
    {
        $result = self::limit(null);
        if ($where) {
            $result->where($where);
        }

        $result = $result->get();

        if ($map) {
            $result->map($map);
        }

        return $result->pluck($value, $key)->toArray();
    }
}
}
