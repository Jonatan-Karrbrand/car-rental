<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Car extends Model
{
  protected $primaryKey = "car_id";

  public static function getAllCars($seats) {

    $cars = DB::table('cars')
    ->where('seats', $seats)
    ->paginate(5);

    return $cars;
  }
}
