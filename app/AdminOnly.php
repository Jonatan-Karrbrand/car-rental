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
}