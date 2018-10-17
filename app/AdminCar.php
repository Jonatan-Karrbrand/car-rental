<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class AdminCar extends Model
{
    protected $table = 'cars';
    protected $primaryKey = 'car_id';
    public $timestamps = false;

    public static function getCars()
    {
        //hämtar alla bilar ifrån cars tabellen och listar 20 bilar på en sida
        $cars = DB::table('cars')
        ->paginate(20);

        return $cars;
    }
}
