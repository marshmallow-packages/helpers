<?php 

namespace Marshmallow\HelperFunctions;

class ReviewHelper
{
	public function ratingToStars (float $rating, $config_overrule = [])
	{
		$max_rating = config('review.max_rating', 5);
		$full_star = config('review.full_star', '<i class="fas fa-star"></i>');
		$half_star = config('review.half_star', '<i class="fas fa-star-half-alt"></i>');
		$empty_star = config('review.empty_star', '<i class="far fa-star"></i>');

		if (isset($config_overrule['max_rating'])) {
			$max_rating = $config_overrule['max_rating'];
		}
		if (isset($config_overrule['full_star'])) {
			$full_star = $config_overrule['full_star'];
		}
		if (isset($config_overrule['half_star'])) {
			$half_star = $config_overrule['half_star'];
		}
		if (isset($config_overrule['max_rating'])) {
			$empty_star = $config_overrule['empty_star'];
		}

		$stars_string = '';
		for ($i=1; $i <= $max_rating; $i++) { 
			if($rating < $i ) {
		        if(is_float($rating) && (round($rating) == $i)){
		            $stars_string .= $half_star;
		        }else{
		            $stars_string .= $empty_star;
		        }
		     }else {
		        $stars_string .= $full_star;
		     }
		}
		return $stars_string;
	}
}