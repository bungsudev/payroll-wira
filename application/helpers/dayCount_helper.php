<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('dayCount_helper'))
{
    function dayCount($from, $to, $day = 5) {
		$from = new DateTime($from);
		$to   = new DateTime($to);
	
		$wF = $from->format('w');
		$wT = $to->format('w');
		if ($wF < $wT)       $isExtraDay = $day >= $wF && $day <= $wT;
		else if ($wF == $wT) $isExtraDay = $wF == $day;
		else                 $isExtraDay = $day >= $wF || $day <= $wT;
	
		return floor($from->diff($to)->days / 7) + $isExtraDay;
	}
}