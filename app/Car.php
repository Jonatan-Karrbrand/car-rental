<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Car extends Model
{
  //primary key
  protected $primaryKey = "car_id";

  public static function getAllCars($result) {
    //om $result är tom någonstans så sätts ett standard värde
    if (!isset($result['seats'])) {
      $result['seats'] = 1;
    }
    if (!isset($result['bhp'])) {
      $result['bhp'] = 1;
    }
    if (!isset($result['from'])) {
      $result['from'] = date('Y-m-d');
    }
    if (!isset($result['to'])) {
      $result['to'] = date('Y-m-d');
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
      ->where('seats', '>=', $result['seats'])
      ->where('bhp', '>=', $result['bhp'])
      ->where($where[0], $where[1], $where[2])
      ->where($box[0], $box[1], $box[2])
      ->where(function ($query) use ($result) {
          $query->where('bookings.booked_from', '>', $result['to'])
                ->orWhere('bookings.booked_to', '<', $result['from'])
                ->orWhere('bookings.car_id', '=', null);
              })
      ->paginate(5);

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
