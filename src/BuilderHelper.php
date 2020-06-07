<?php

namespace Marshmallow\HelperFunctions;

use Illuminate\Database\Eloquent\Builder;

class BuilderHelper
{
	/**
	 * Get items that are active compared to the current date.
	 * @param  Builder $builder Illuminate\Database\Eloquent\Builder
	 * @param  string  $valid_from_column Column name in the database
	 * @param  string  $valid_till_column Column name in the database
	 * @return Illuminate\Database\Eloquent\Builder
	 */
	public function activeBetweenDates(Builder $builder, $valid_from_column = 'valid_from', $valid_till_column = 'valid_till')
	{
		$builder->where(function ($builder) use ($valid_from_column, $valid_till_column) {
			/**
			 * If both are null, we handle this as active.
			 */
			$builder->whereNull($valid_from_column)->whereNull($valid_till_column);
		})->orWhere(function ($builder) use ($valid_from_column, $valid_till_column) {

			/**
			 * From is null, and now() is lower than the end date.
			 */
			$builder->whereNull($valid_from_column)->where($valid_till_column, '>=', now());
		})->orWhere(function ($builder) use ($valid_from_column, $valid_till_column) {

			/**
			 * From is is in the past and the end dat is null
			 */
			$builder->where($valid_from_column, '<=', now())->whereNull($valid_till_column);
		})->orWhere(function ($builder) use ($valid_from_column, $valid_till_column) {

			/**
			 * From is in the past and till is in the future.
			 */
			$builder->where($valid_from_column, '<=', now())->where($valid_till_column, '>=', now());
		});

		return $builder;
	}
}
