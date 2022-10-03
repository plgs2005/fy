<?php

namespace App\Influencer\Utils;

use Carbon\Carbon;

class Time
{
    /** 
     * Checks if the given post is older than the given period in days.
     * Returns true if post older than period
     * Returns false if post younger then period
     */
    public static function olderThanDays($timestamp, $period = 360)
    {
        $today = Carbon::today();
        $periodEnd = $today->subDays($period);

        $temp = new Carbon($timestamp);
        if ($temp->isBefore($periodEnd)) {
            return true;
        } else {
            return false;
        }
    }

}