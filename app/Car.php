<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Car extends Model
{
    public static function getOneCar($id) {
        $result = DB::table('cars')
        ->where('cars.car_id', $id)
        ->get();
        return $result;
    }
/*
    public static function getAllBookings() {
        $result = DB::table('booking')
        ->join('cars', 'booking.car_id', '=', 'cars.car_id')
        ->join('users', 'booking.user_id', '=', 'users.user_id')
        ->select('cars.model', 'users.username', 'booking.total_price', 'booking.booked_from', 'booking.booked_to')
        ->get();
        return $result;
    }*/
/*
    public static function storeBooking() {
        $result = DB::table('booking')
        ->insert();
    }*/
}
