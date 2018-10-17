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
