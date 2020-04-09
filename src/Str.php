<?php 

namespace Marshmallow\HelperFunctions;

class Str extends \Illuminate\Support\Str
{
	public function cleanPhoneNumber ($phone_number)
	{
		return $this->numbersOnly($phone_number);
	}

	public function numbersOnly ($string)
	{
		return preg_replace('/[^0-9]/', '', $string);
	}

	public function numbersAndLettersOnly ($string)
	{
		return preg_replace('/[^\w]/', '', $string);
	}
}