<?php 

namespace Marshmallow\HelperFunctions;

class Str extends \Illuminate\Support\Str
{
	public function cleanPhoneNumber ($phone_number)
	{
		return preg_replace('/[^0-9]/', '', $phone_number);
	}
}