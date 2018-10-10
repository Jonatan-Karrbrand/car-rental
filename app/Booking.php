<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Booking extends Model
{
    // Table Name
    protected $table = 'bookings';
    // Primary Key
    protected $primaryKey = "booking_id";
    // No timestamps
    public $timestamps = false;

    public static function getAllBookings() {
        $result = DB::table('bookings')
        ->join('cars', 'bookings.car_id', '=', 'cars.car_id')
        ->join('users', 'bookings.user_id', '=', 'users.user_id')
        ->select('cars.car_id', 'cars.model', 'users.email', 'bookings.total_price', 'bookings.booked_from', 'bookings.booked_to', 'bookings.timestamp')
        ->get();
        return $result;
    }

    public static function calcTotalPrice($id) {
        $result = DB::table('cars')
        ->select('cars.price_per_day')
        ->where('cars.car_id', $id)
        ->get();
        return $result;
    }
}
