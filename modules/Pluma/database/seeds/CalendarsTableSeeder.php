<?php

namespace Pluma\Database\Seeds;

use Illuminate\Database\Seeder;
use Pluma\Models\Calendar;
use DateTime;

class CalendarsTableSeeder extends Seeder
{

    public function run()
    {
        /**
         * Seeds
         */
        $start_date = DateTime::createFromFormat('Y-m-d H:i:s', '2018-01-01 00:00:00');
        $end_date = DateTime::createFromFormat('Y-m-d H:i:s', '2020-31-12 23:59:59');
        $current = clone $start_date;

        while ($current < $end_date) {

            $date         = $current->format('Y-m-d');
            $datetime     = $current->format('Y-m-d H:i:s');

            $weekend      = in_array( $current->format('D'), ['Sat', 'Sun'] );

            $day          = $current->format('d');
            $month        = $current->format('n'); // month num
            $year         = $current->format('Y');
            $week         = $current->format('W');
            $weekday      = (int) $current->format('w'); // weekday num

            $month_name   = $current->format('F');
            $weekday_name = $current->format('l');
            $holiday      = in_array( $current->format('m-d'), Calendar::holidays() );

            $calendar = new Calendar();
            $calendar->date = $date;
            $calendar->datetime = $datetime;
            $calendar->weekend = $weekend;
            $calendar->day = $day;
            $calendar->month = $month;
            $calendar->year = $year;
            $calendar->week = $week;
            $calendar->weekday = $weekday;
            $calendar->month_name = $month_name;
            $calendar->weekday_name = $weekday_name;
            $calendar->holiday = $holiday;
            $calendar->save();

            $current = $current->modify('+1 day');
        }
    }

}