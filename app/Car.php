<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Car extends Model
{
  protected $primaryKey = "car_id";

  public static function getAllCars($result) {

    if (!isset($result['seats'])) {
      $result['seats'] = 1;
    }
    if (!isset($result['bhp'])) {
      $result['bhp'] = 1;
    }
    if (!isset($result['from'])) {
      $result['from'] = '2018-10-08';
    }
    if (!isset($result['to'])) {
      $result['to'] = '2018-10-08';
    }

    if (!isset($result['type']) || $result['type'] == 'alla') {
        $where = ['bhp', '>=', $result['bhp']];
    }
    else {
      $where = ['car_type', '=', $result['type']];
    }

    if (!isset($result['gearbox']) || $result['gearbox'] == 'alla') {
      $box = ['bhp', '>=', $result['bhp']];
    }
    else {
      $box = ['gearbox', '=', $result['gearbox']];
    }

    // if ($result['to'] == $result['from']) {
    //   $result['from'] = '';
    // }
    //
    // $result['from'] = $result['from']


    // $resultFrom = '2018-10-13';
    // $resultTo = '2018-10-16';
    // $array = [];
    //
    // $var = DB::table('bookings')
    // ->select('date')
    // ->join('booked-dates', 'bookings.booking_id', 'booked-dates.booking_id')
    // ->get();
    //
    // $date = json_decode($var, true);
    // $carBookedStatus = $date;
    //
    // foreach ($carBookedStatus as $key => $value) {
    //   $thisDate = $carBookedStatus[$key]['date'];
    //
    //   array_push($array, $thisDate);
    //
    // }
    //
    // foreach ($array as $key => $value) {
    //
    //   if (in_array($resultFrom, $array)) {
    //     echo "detta datum är bookat";
    //     echo "<br>";
    //   }
    //   else {
    //     echo "ej bookat";
    //     echo "<br>";
    //   }
    // }

    $resultat = DB::select( DB::raw(
      "SELECT *
      FROM cars
      WHERE cars.car_id NOT IN(
      SELECT car_id
      FROM bookings
      WHERE bookings.booked_from >= '2018-10-10 00:00:00'
      AND bookings.booked_to < '2018-10-15 23:59:59')"
    ));


    /*

    $cars = DB::table('cars')
      ->where('seats', '>=', $result['seats'])
      ->where('bhp', '>=', $result['bhp'])
      ->where($where[0], $where[1], $where[2])
      ->where($box[0], $box[1], $box[2])
      ->join('bookings', 'cars.car_id', 'bookings.booking_id')

      ->join('booked-dates', 'bookings.booking_id', 'booked-dates.booked_dates_id')
      // ->where()
      // ->whereNotBetween('bookings.booked_from', [$result['from'], $result['to']])
      // ->whereNotBetween('bookings.booked_to', [$result['from'], $result['to']])
      ->paginate(5);

      ->whereNotBetween('bookings.booked_from', [$result['from'], $result['to']])
      ->whereNotBetween('bookings.booked_to', [$result['from'], $result['to']])
      ->paginate(5);*/

      $cars = DB::select( DB::raw(
        "SELECT *
        FROM cars
       WHERE cars.car_id NOT IN(
          SELECT car_id
          FROM bookings
           WHERE bookings.booked_from <= '2018-10-18 00:00:00'
             AND bookings.booked_to >= '2018-10-19 23:59:59'
             OR bookings.booked_from >= '2018-10-18 00:00:00'
             AND bookings.booked_to <= '2018-10-19 23:59:59')"
    ));


    return $resultat;

  }



  // get one car
  public static function getOneCar($id) {
    $result = DB::table('cars')
      ->where('cars.car_id', $id)
      ->get();

    return $result;
   }
}
