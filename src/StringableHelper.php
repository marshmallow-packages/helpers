<?php

namespace Marshmallow\HelperFunctions;

use BadMethodCallException;
use Illuminate\Support\Stringable;
use Marshmallow\HelperFunctions\StrHelper;
use Marshmallow\HelperFunctions\Facades\Str;

class StringableHelper extends Stringable
{
	public function __call($name, $arguments)
    {
    	if (!method_exists(StrHelper::class, $name)) {
    		throw new BadMethodCallException("Method Marshmallow\HelperFunctions\StrHelper::$name does not exist.", 1);
    	}

    	$arguments = array_merge(
    		[
    			$this->value,
    		],
    		$arguments
    	);

    	$this->value = Str::$name(...$arguments);
    	return $this;
    }
}
