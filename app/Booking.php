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

    public static function getAllBookings($id) {
        $result = DB::table('bookings')
        ->join('cars', 'bookings.car_id', '=', 'cars.car_id')
        ->join('users', 'bookings.user_id', '=', 'users.user_id')
<<<<<<< HEAD
        ->select('bookings.booking_id', 'cars.car_id', 'cars.model', 'users.email', 'bookings.total_price', 'bookings.booked_from', 'bookings.booked_to', 'bookings.timestamp')
=======
        ->select('cars.car_id', 'cars.model', 'users.email', 'bookings.total_price', 'bookings.booked_from', 'bookings.booked_to', 'bookings.timestamp')
        ->where('cars.car_id', $id)
>>>>>>> 3e19e511c40910ca6f4494458bb0e076909a324e
        ->get();
        return $result;
    }
}
