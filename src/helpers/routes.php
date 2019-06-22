<?php
	
	if (!function_exists('routeHasOne')) {

		/**
	     * function routeHasOne
	     * Check if a one of a group of routers exists. This can be used
	     * to build menu's like we use in the office menu's.
	     *
	     * @return boolean true|false
	     */
		function routeHasOne (array $routes)
		{
			foreach ($routes as $route) {
				if ((Route::has($route))) {
					return true;
				}
			}
			return false;
		}

	}

	