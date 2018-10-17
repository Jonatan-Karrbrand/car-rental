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


// HÄR !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    $resultFrom = '2018-10-13';
    $resultTo = '2018-10-18';
    $array = [];
    $theseCarsAreBooked = [];
    $dontShowThisCar = '';
    $newArray = [];

    // $var = DB::table('bookings')
    // ->select('date', 'bookings.car_id')
    // ->join('booked_dates', 'bookings.booking_id', 'booked_dates.booking_id')
    // ->get();

    $var = DB::select( DB::raw(
      "SELECT * FROM `cars`
      LEFT JOIN bookings ON cars.car_id = bookings.car_id
      WHERE (('2018-10-10' NOT BETWEEN booked_from AND booked_to)
      AND ('2018-10-18' NOT BETWEEN booked_from AND booked_to))
      OR bookings.car_id IS NULL"
    ));


    // $date = json_decode($var, true);
    // $carBookedStatus = $date;
    // foreach ($carBookedStatus as $key => $value) {
    //   $thisDate = $carBookedStatus[$key]['date'];
    //   $thisCar = $carBookedStatus[$key]['car_id'];
    //
    //   array_push($array, [$thisDate, $thisCar]);
    //
    //
    // }
    // array_push($newArray, $array);
    //
    //
    //
    //
    //
    //   foreach ($array as $key => $value) {
    //
    //     if (in_array($resultFrom, $array) || in_array($resultTo, $array)) {
    //       echo "detta datum är bookat";
    //       echo "<br>";
    //       echo $value;
    //
    //
    //     }
    //     else {
    //       echo "ej bookat";
    //       echo "<br>";
    //         echo $value[1];
    //     }
    //   }
    //
    //
    // $bilar = DB::table('cars')
    //   ->where('seats', '>=', $result['seats'])
    //   ->where('bhp', '>=', $result['bhp'])
    //   ->where($where[0], $where[1], $where[2])
    //   ->where($box[0], $box[1], $box[2])
    //   ->leftJoin('bookings', 'cars.car_id', 'bookings.booking_id')
    //   // ->leftJoin('booked_dates', 'bookings.booking_id', 'booked_dates.booking_id')
    //
    //   // ->where(function($query) use ($resultFrom ,$theseCarsAreBooked)
    //   //   {
    //   //     $query->where('booked_dates.car_id' ,'!=', '1')
    //   //       ->orWhere('booked_dates.date', '!=',  $resultFrom)  ;
    //   //   })
    //
    //   ->orWhere('bookings.car_id', '=',  null)
    //   // ->whereNotIn('booked_dates.date', $resultFrom)



      // ->whereNotBetween('bookings.booked_from', [$result['from'], $result['to']])
      // ->whereNotBetween('bookings.booked_to', [$result['from'], $result['to']])


      // ->whereNotBetween('bookings.booked_from', [$result['from'], $result['to']])
      // ->whereNotBetween('bookings.booked_to', [$result['from'], $result['to']])
      // ->paginate(5);


// SLUT !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!


    // $resultat = DB::select( DB::raw(
    //   "SELECT * FROM `cars`
    //   LEFT JOIN bookings ON cars.car_id = bookings.car_id
    //   WHERE (('2018-10-10' NOT BETWEEN booked_from AND booked_to)
    //   AND ('2018-10-18' NOT BETWEEN booked_from AND booked_to))
    //   OR bookings.car_id IS NULL"
    // ));

    // $resultat2 = DB::table('cars')
    //   ->leftJoin('bookings', 'cars.car_id', 'bookings.car_id')
    //   ->whereNotBetween('booked_from', '2018-10-10', '2018-10-18')
    //   WHERE 2018-10-16 NOT BETWEEN booked_from AND booked_to
    //   OR bookings.car_id IS NULL"
    //   ->get();


    /*

    $cars = DB::table('cars')
      ->where('seats', '>=', $result['seats'])
      ->where('bhp', '>=', $result['bhp'])
      ->where($where[0], $where[1], $where[2])
      ->where($box[0], $box[1], $box[2])
      ->join('bookings', 'cars.car_id', 'bookings.booking_id')

      ->join('booked_dates', 'bookings.booking_id', 'booked_dates.booked_dates_id')
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
           WHERE bookings.booked_from <= '2018-10-10 00:00:00'
             AND bookings.booked_to >= '2018-10-11 23:59:59'
             OR bookings.booked_from >= '2018-10-10 00:00:00'
             AND bookings.booked_to <= '2018-10-11 23:59:59')"
    ));

  //   $cars2 = DB::select( DB::raw(
  //     "SELECT *
  //     FROM cars
  //     JOIN booking
  //     ON bookings.booking_id = cars.car_id
  //     JOIN booked_dates
  //     On booked_dates.booked_dates_id = bookings.booking_id
  //     WHERE booked_dates.date !=  $resultFrom
  //     AND booked_dates.car_id != $theseCarsAreBooked[0]"
  // ));

  // $cars3 = DB::select(DB::raw(
  //   "SELECT *
  //   FROM `bookings`
  //   right JOIN cars ON bookings.car_id = cars.car_id
  //   WHERE
  //     (('2018-10-08' < booked_from)
  //     OR ('2018-10-08' > booked_to)
  //     OR (bookings.car_id IS NULL))"
  //   ));

    $bilar = DB::table('bookings')
      ->rightJoin('cars', 'bookings.car_id', 'cars.car_id')
      ->where(function ($query) use ($result) {
              $query->where('bookings.booked_from', '>', $result['to'])
                    ->orWhere('bookings.booked_to', '<', $result['from'])
                    ->orWhere('bookings.car_id', '=', null);
          })
      ->get();


    return $bilar;



  }



  // get one car
  public static function getOneCar($id) {
    $result = DB::table('cars')
      ->where('cars.car_id', $id)
      ->get();

    return $result;
   }
}
