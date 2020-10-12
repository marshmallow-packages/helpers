<?php

namespace Marshmallow\HelperFunctions;

use Marshmallow\HelperFunctions\StringableHelper;

class StrHelper extends \Illuminate\Support\Str
{
	public static function of($string)
    {
        return new StringableHelper($string);
    }

    public static function generate()
    {
        return new StringableHelper('');
    }

	public function remove($string, $remove)
	{
		return str_replace($remove, '', $string);
	}

	public function removeSpaces($string)
	{
		return $this->remove($string, ' ');
	}

	public function cleanPhoneNumber($phone_number)
	{
		return $this->numbersOnly($phone_number);
	}

    public function phonenumberWithCountryCode($phone_number, $country_code = '31', $use_plus_instead_of_zeros = true)
    {
        $phone_number = $this->cleanPhoneNumber($phone_number);

        if (substr($phone_number, 0, 2) == '00') {
            $phone_number = substr($phone_number, 2, strlen($phone_number));
        }

        if (substr($phone_number, 0, 2) == $country_code) {
            $phone_number = '0' . substr($phone_number, 2, strlen($phone_number));
        }

        $phone_number = $country_code . substr($phone_number, 1, strlen($phone_number));

        if (!$use_plus_instead_of_zeros) {
            return '00' . $phone_number;
        }

        return '+' . $phone_number;
    }

	public function numbersOnly($string)
	{
		return preg_replace('/[^0-9]/', '', $string);
	}

	public function numbersAndLettersOnly($string)
	{
		return preg_replace('/[^\w]/', '', $string);
	}

	public function readmore($string, $lenght_first_part, $return_this_part = null)
	{
		$new_parts = [];
		$parts = $this->paragraphsAsArray($string);
		if (is_string($parts)) {
			$new_parts = [
				substr($string, 0, $lenght_first_part),
				substr($string, $lenght_first_part),
			];
		} else {
			$string_builder = '';

			foreach ($parts as $part) {
				$paragraph_content = $this->getParagraphContent($part);
				$string_builder .= $paragraph_content;

				if (isset($new_parts[0])) {
					if (!isset($new_parts[1])) {
						$new_parts[1] = '';
					}
					$new_parts[1] .= $part;
					continue;
				}

				if (strlen($string_builder) > $lenght_first_part) {
					$new_parts[0] = '<p>'. substr($paragraph_content, 0, $lenght_first_part) .'</p>';
					$new_parts[1] = '<p>'. trim(substr($paragraph_content, $lenght_first_part)) .'</p>';
				} elseif (strlen($string_builder) == $lenght_first_part) {
					$new_parts[0] = '<p>'. $paragraph_content .'</p>';
				}
			}
		}

		if ($return_this_part) {
			return $new_parts[($return_this_part - 1)];
		}
		return $new_parts;
	}

	public function getParagraphContent($paragraph)
	{
		preg_match("/<p>(.+?)<\/p>/i", $paragraph, $matches);
		return $matches[1];
	}

	public function paragraphsAsArray($string)
	{
		preg_match_all('%(<p[^>]*>.*?</p>)%i', $string, $matches);
		if (isset($matches[0]) && !empty($matches[0])) {
			return $matches[0];
		}
		return $string;
	}

	public function getFirstParagraph($string, $number_of_paragraphs = 1, $return_array = false)
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

	public function getAllButFirstParagraph($string, $number_of_paragraphs_to_skip = 1, $return_array = false)
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

	public function isJson($value)
	{
		json_decode($value);
        return json_last_error() === JSON_ERROR_NONE;
	}

	/**
     * Determine whether any of the provided strings in
     * the haystack contain the needle.
     *
     * @param  array  $haystacks
     * @param  string  $needle
     * @return bool
     */
	public function anyContains($haystacks, $needle)
	{
		$haystacks = (array) $haystacks;

        foreach ($haystacks as $haystack) {
            if (is_array($haystack)) {
                return $this->anyContains($haystack, $needle);
            } elseif (self::contains(strtolower($haystack), strtolower($needle))) {
                return true;
            }
        }

        return false;
	}
}
