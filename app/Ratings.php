<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Ratings extends Model
{
    // Table Name
    protected $table = 'rating';
    // Primary Key
    protected $primaryKey = "rating_id";
    // No timestamps
    public $timestamps = false;

    public static function getRating($id){
        $result = DB::table('rating')
            ->join('users', 'rating.user_id', 'users.user_id')
            ->where('car_id', $id)
            ->avg('rating');

        return $result;
    }

    public static function getUserVoted($id)
    {
        $result = DB::table('rating')
        ->where('car_id', $id)
        ->select('user_id')
        ->first();

        return $result;
    }
}
