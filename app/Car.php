<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Car extends Model
{
  protected $primaryKey = "car_id";

  public static function getAllCars($seats, $bhp, $from, $to) {

    $cars = DB::table('cars')
      ->where('seats', '>=', $seats)
      ->where('bhp', '>=', $bhp)
      ->join('booking', 'cars.car_id', 'booking.booking_id')
      // ->whereNotBetween('booking.booked_from', ['2018-10-15','2018-10-20'])
      // ->whereNotBetween('booking.booked_to', ['2018-10-15','2018-10-20'])
      ->whereNotBetween('booking.booked_from', [$from, $to])
      ->whereNotBetween('booking.booked_to', [$from, $to])
      ->paginate(5);

    return $cars;
  }


  // get one car 
  public static function getOneCar($id) {
    $result = DB::table('cars')
      ->where('cars.car_id', $id)
      ->get();

    return $result;
   }
}
