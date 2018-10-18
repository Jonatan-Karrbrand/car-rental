<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Frontpage extends Model
{
    public static function getAllAvailableCarsToday() {
        //sätter variablarna till dagen datum och till start och slut tid på dagen
        $todaysDateStart = date("Y-m-d") . ' 00:00:00';
        $todaysDateEnd =  date("Y-m-d") . ' 23:59:59';

        //querryn för hämta bilarna som är lediga idag
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
