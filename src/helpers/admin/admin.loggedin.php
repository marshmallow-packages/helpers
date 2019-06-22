<?php

	if (!function_exists('adminLoggedin')) {

		/**
	     * function adminLoggedin
	     * Short hand function to check if a admin is loggedin
	     *
	     * @return boolean true|false
	     */
		function adminLoggedin ()
		{
			return (Auth::guard('marshmallow-office')->check());
		}

	}