<?php
	
	if (!function_exists('admin')) {

		/**
	     * function admin
	     * Short hand function to get the authenticated marshmallow
		 * office user.
	     *
	     * @return  \Marshmallow\Office\App\Domain\Admin\Admin::class
	     */
		function admin ()
		{
			return Auth::guard('marshmallow-office')->user();
		}

	}

	