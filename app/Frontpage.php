<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Frontpage extends Model
{
    public static function getAllAvailableCarsToday() {
        $todaysDateStart = date("Y-m-d") . ' 00:00:00';
        $todaysDateEnd =  date("Y-m-d") . ' 23:59:59';

        $result = DB::select( DB::raw(
          "SELECT *
          FROM cars
          WHERE cars.car_id NOT IN(
            SELECT car_id
            FROM bookings
            WHERE bookings.booked_from <= '$todaysDateStart'
            AND bookings.booked_to >= '$todaysDateEnd'
            OR bookings.booked_from >= '$todaysDateStart'
            AND bookings.booked_to <= '$todaysDateEnd')
            LIMIT 3"
        ));

        return $result;

    }
}
