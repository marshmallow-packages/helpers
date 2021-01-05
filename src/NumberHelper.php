<?php

namespace Marshmallow\HelperFunctions;

class NumberHelper
{
    public function oddEvenItemRow($loop_count, $items_per_row = 2)
    {
        $test_counter = 0;
        $odd_even = 'even';

        for ($i=0; $i <= $loop_count; $i++) {
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
}
