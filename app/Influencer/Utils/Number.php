<?php

namespace App\Influencer\Utils;

class Number
{
    /** 
     * Checks if number is between the informed range
     */
    public static function between($number, $start, $end)
    {
        if ($number >= $start AND $number <= $end) {
            return true;
        }
    }

}