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

	public function paragraphsAsArray ($string)
	{
		preg_match_all('%(<p[^>]*>.*?</p>)%i', $string, $matches);
		if (isset($matches[0]) && !empty($matches[0])) {
			return $matches[0];
		}
		return $string;
	}

	public function getFirstParagraph ($string, $number_of_paragraphs = 1, $return_array = false)
	{
		$paragraphs = $this->paragraphsAsArray($string);
		if (is_array($paragraphs)) {
			$return_paragraphs = [];
			for ($i=0; $i < $number_of_paragraphs; $i++) { 
				$return_paragraphs[] = $paragraphs[$i];
			}

			if ($return_array) {
				return $return_paragraphs;
			}

			return join('', $return_paragraphs);
		}
		return $string;
	}

	public function getAllButFirstParagraph ($string, $number_of_paragraphs_to_skip = 1, $return_array = false)
	{
		$paragraphs = $this->paragraphsAsArray($string);
		if (is_array($paragraphs)) {
			for ($i=0; $i < $number_of_paragraphs_to_skip; $i++) { 
				unset($paragraphs[$i]);
			}

			if ($return_array) {
				return $paragraphs;
			}
			return join('', $paragraphs);
		}
		return $string;
	}
}