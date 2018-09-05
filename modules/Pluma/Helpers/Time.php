<?php

namespace Pluma\Helpers;

use StdClass;

/*
|--------------------------------------------------------------------------
| Time Helpers
|--------------------------------------------------------------------------
|
| Here are some functions to help in manipulating time.
|
| @author John Lioneil P. Dionisio <john.dionisio1@gmail.com>
|
*/
class Time
{
    const MINUTES_IN_SECONDS = 60;
    const HOURS_IN_SECONDS = 3600;

    /**
     * Converts a time to points.
     *
     * @param  time  $time       the time to be converted can be 00:00 or 00:00:00
     * @param  boolean $secondhand if the format is 00:00:00
     * @param  integer $round      round to the nearest value
     *
     * @return float
     */
    public static function to_points($time, $secondhand = true, $round = 2)
    {
        $hms = explode( ":", $time );

        if ( $secondhand )
            return round( ( $hms[0] + ( $hms[1] / self::MINUTES_IN_SECONDS ) + ( $hms[2] / self::HOURS_IN_SECONDS ) ), $round);

        return round( ( $hms[0] + ( $hms[1] / self::MINUTES_IN_SECONDS ) ), $round);
    }

    /**
     * Calculates the difference between two times.
     *
     * @param  time $start
     * @param  time $end
     * @param  string $format
     *
     * @return date
     */
    public static function total($start, $end, $format = "H:i:s")
    {
        $diff = strtotime( $end ) - strtotime( $start );
        return date( $format, $diff );
    }
}