<?php

namespace Marshmallow\HelperFunctions\Observers;

class ModelObserver
{
	public function saving($model)
    {
    	if (method_exists($model, 'applyDefaultAttributes')) {
    		$model->applyDefaultAttributes();
    	}
    	if (method_exists($model, '__saving')) {
    		$model->__saving();
    	}
    }

	public static function observe($class_name)
	{
		$class_name::observe(
			ModelObserver::class
		);
	}
}
