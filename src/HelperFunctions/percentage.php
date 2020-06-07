<?php

if (!function_exists('percentage')) {

	function percentage($mark, $total): float
	{
		if (is_array($mark) || $mark instanceof Countable) {
		    $mark = count($mark);
		}

		if (is_array($total) || $total instanceof Countable) {
		    $total = count($total);
		}

		if ($mark == 0 || $total == 0) {
			return 0;
		}

		return ($mark / $total) * 100;
	}
}
