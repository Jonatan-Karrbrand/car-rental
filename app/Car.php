<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Car extends Model
{
    public static function getOneCar($id) {
        $result = DB::table('cars')
        ->where('cars.car_id', $id)
        ->get();
        return $result;
    }
}
