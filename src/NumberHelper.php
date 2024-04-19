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
        $cleanedString = preg_replace('/[^\d,\.]/', '', $string);

        // Count the commas and dots
        $commaCount = substr_count($cleanedString, ',');
        $dotCount = substr_count($cleanedString, '.');

        // Determine the decimal separator and the thousand separator based on counts and position
        if ($commaCount > 0 && $dotCount > 0) {
            // Both comma and dot present, the last occurrence determines the decimal separator
            if (strrpos($cleanedString, ',') > strrpos($cleanedString, '.')) {
                // Comma is the decimal separator
                $cleanedString = str_replace('.', '', $cleanedString); // Remove thousand separator
                $cleanedString = str_replace(',', '.', $cleanedString); // Convert decimal separator
            } else {
                // Dot is the decimal separator
                $cleanedString = str_replace(',', '', $cleanedString); // Remove thousand separator
            }
        } elseif ($commaCount > 0) {
            // Only commas are present, likely used as decimal separator
            if ($commaCount == 1 && $cleanedString[-3] == ',') {
                // It's used as a decimal separator
                $cleanedString = str_replace(',', '.', $cleanedString);
            } else {
                // It's used as a thousand separator
                $cleanedString = str_replace(',', '', $cleanedString);
            }
        } elseif ($dotCount > 0) {
            // Only dots are present
            if ($dotCount == 1 && $cleanedString[-3] == '.') {
                // It's used as a decimal separator, nothing to change
            } else {
                // It's used as a thousand separator
                $cleanedString = str_replace('.', '', $cleanedString);
            }
        }

        return (float) $cleanedString;
    }
}
