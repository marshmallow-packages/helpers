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

	public function getFirstParagraph ($string)
	{
		$paragraphs = $this->paragraphsAsArray($string);
		if (is_array($paragraphs)) {
			return $paragraphs[0];
		}
		return $string;
	}

	public function getAllButFirstParagraph ($string)
	{
		$paragraphs = $this->paragraphsAsArray($string);
		if (is_array($paragraphs)) {
			unset($paragraphs[0]);
			return $paragraphs;
		}
		return $string;
	}

	public function getAllButFirstParagraphAsString ($string)
	{
		$paragraphs = $this->getAllButFirstParagraph($string);
		if (is_array($paragraphs)) {
			return join('', $paragraphs);
		}

		return $string;
	}
}