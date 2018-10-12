<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Frontpage extends Model
{
    public static function getAllAvailableCarsToday() {
        //$todaysDate = date("Y-m-d");
        //$TomorrowsDate = $todaysDate->modify('+1 day');
        
        $result = DB::table('cars')
        ->join('bookings', 'cars.car_id', 'bookings.booking_id')
        ->select(DB::raw(
            "SELECT * 
            FROM bookings
            WHERE begin <= '2018-10-11'
            AND end >= '2018-10-11'"
        ))
        ->get();
        
        return $result;
    }
}
//->whereNotBetween('bookings.booked_from', ['2018-10-10', '2018-10-11'])
//->whereNotBetween('bookings.booked_to', ['2018-10-10', '2018-10-11'])