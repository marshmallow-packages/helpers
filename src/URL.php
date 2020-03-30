<?php 

namespace Marshmallow\HelperFunctions;

class URL extends \Illuminate\Support\Facades\URL
{
	public function isInternal ($url)
	{
		return strpos($url, env('APP_URL')) === 0;
	}
}