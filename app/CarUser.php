<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;


class CarUser extends Model
{
    public static function getUser($id) {
        //hämtar en användare
        $result = DB::table('users')
        ->where('users.user_id', $id)
        ->get();
        return $result;
    }
    public static function getUserBookings($id) {
        //hämtar alla bokningar som är kopplade till en användare
        $result = DB::table('bookings')
        ->join('cars', 'cars.car_id', 'bookings.car_id')
        ->where('bookings.user_id', $id)
        ->get();
        return $result;
    }
}
