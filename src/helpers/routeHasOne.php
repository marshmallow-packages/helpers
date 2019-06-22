<?php
	
	if (!function_exists('routeHasOne')) {

		/**
	     * function admin
	     * Short hand function to get the authenticated marshmallow
		 * office user.
	     *
	     * @return  \Marshmallow\Office\App\Domain\Admin\Admin::class
	     */
		function routeHasOne ($route)
		{
			return (Route::has($route));
		}

	}

	