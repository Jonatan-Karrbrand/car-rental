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

    $cars = DB::table('cars')
      ->where('seats', '>=', $result['seats'])
      ->where('bhp', '>=', $result['bhp'])
      ->where($where[0], $where[1], $where[2])
      ->where($box[0], $box[1], $box[2])
      ->join('bookings', 'cars.car_id', 'bookings.booking_id')
      ->whereNotBetween('bookings.booked_from', [$result['from'], $result['to']])
      ->whereNotBetween('bookings.booked_to', [$result['from'], $result['to']])
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
