<?php
	
	if (!function_exists('routeActive')) {

		/**
	     * function routeActive
	     * Short hand function to check if the current route is active.
	     *
	     * @return boolean true|false
	     */
		function routeActive ($route_name)
		{
			return (Request::route()->getName() == $route_name);
		}

	}

	