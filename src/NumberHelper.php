<?php

namespace Marshmallow\HelperFunctions;

class NumberHelper
{
    public function oddEvenItemRow($loop_count, $items_per_row = 2)
    {
        $test_counter = 0;
        $odd_even = 'even';

        for ($i = 0; $i <= $loop_count; $i++) {
            $test_counter++;
            $keys[$i] = $odd_even;

            if ($test_counter == $items_per_row) {
                $odd_even = ($odd_even == 'even') ? 'odd' : 'even';
                $test_counter = 0;
            }
        }

        return $keys[$loop_count];
    }

    public function isOddItemRow($loop_count, $items_per_row = 2)
    {
        return $this->oddEvenItemRow($loop_count, $items_per_row) === 'odd';
    }

    public function isEvenItemRow($loop_count, $items_per_row = 2)
    {
        return $this->oddEvenItemRow($loop_count, $items_per_row) === 'even';
    }

    public function floatFromString(string $string)
    {
        // Remove any characters that are not digits, comma, or dot
        $cleaned_string = preg_replace("/[^\d,\.]/", "", $string);

        // Count the commas and dots
        $comma_count = substr_count($cleaned_string, ",");
        $dot_count = substr_count($cleaned_string, ".");

        // Determine the decimal separator and the thousand separator based on counts and position
        if ($comma_count > 0 && $dot_count > 0) {
            // Both comma and dot present, the last occurrence determines the decimal separator
            if (strrpos($cleaned_string, ",") > strrpos($cleaned_string, ".")) {
                // Comma is the decimal separator
                $cleaned_string = str_replace(".", "", $cleaned_string); // Remove thousand separator
                $cleaned_string = str_replace(",", ".", $cleaned_string); // Convert decimal separator
            } else {
                // Dot is the decimal separator
                $cleaned_string = str_replace(",", "", $cleaned_string); // Remove thousand separator
            }
        } elseif ($comma_count > 0) {
            // Only commas are present
            if ($comma_count == 1 && preg_match('/,\d{1,2}$/', $cleaned_string)) {
                // Comma is followed by one or two digits, it's used as a decimal separator
                $cleaned_string = str_replace(",", ".", $cleaned_string);
            } else {
                // Commas likely used as thousand separators
                $cleaned_string = str_replace(",", "", $cleaned_string);
            }
        } elseif ($dot_count > 0) {
            // Only dots are present
            if ($dot_count == 1 && preg_match('/\.\d{1,2}$/', $cleaned_string)) {
                // Dot is followed by one or two digits, it's used as a decimal separator
                // Nothing to change
            } else {
                // Dots used as thousand separators
                $cleaned_string = str_replace(".", "", $cleaned_string);
            }
        }

        return (float) $cleaned_string;
    }
}
