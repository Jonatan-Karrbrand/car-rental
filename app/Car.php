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
  
  public static function getOneCar($id) {
       $result = DB::table('cars')
       ->where('cars.car_id', $id)
       ->get();

       return $result;
   }
}
