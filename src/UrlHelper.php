<?php

namespace Marshmallow\HelperFunctions;

use \Illuminate\Support\Facades\URL;

class UrlHelper extends URL
{
	public function isInternal($url)
	{
		return strpos($url, env('APP_URL')) === 0;
	}

	public function buildFromArray(array $url_parts): string
	{
		$url_parts = array_filter($url_parts);
		$route = '/';
		foreach ($url_parts as $part) {
			$part = rtrim($part, '/');
			$part = ltrim($part, '/');

			if (substr($route, -1) !== '/' && substr($part, 0, 1) !== '/') {
				$route .= '/';
			}
			$route .= $part;
		}
		return $route;
	}

	public function isNova($request)
	{
		return (isset($request->segments()[0]) && in_array($request->segments()[0], [
			'nova-api',
            'nova-vendor',
			ltrim(config('nova.path'), '/')
		]));
	}

	public function isNotNova($request)
	{
		return (!$this->isNova($request));
	}
}
