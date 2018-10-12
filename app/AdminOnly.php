<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class AdminOnly extends Model
{
    protected $table = 'cars';
    protected $primaryKey = 'car_id';
    public $timestamps = false;

    public static function getCars()
    {
        $cars = DB::table('cars')
        ->get();

        return $cars;
    }
    public static function uppdateCar($request, $id)
    {
        $uppdateCar = DB::teable('cars')
        ->where('id', $id)
        ->update([
            'model' => $request['model'],
            'price_per_day' => $request['price_per_day'],
            'seats' => $request['seats'], 'bhp' => $request['bhp'],
            'car_type' => $request['car_type'],
            'gearbox' => $request['gearbox']
            ]);
        
        return $uppdateCar;
    }
}
