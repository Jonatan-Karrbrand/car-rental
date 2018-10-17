<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
  /*  protected $fillable = [
      'product_id', 'user_id', 'rating'
    ];*/
    // Table Name
    protected $table = 'rating';
    // Primary Key
    protected $primaryKey = "rating_id";
    // No timestamps
    public $timestamps = false;

    public static function getAllRatingMedel() {
        $result = DB::table('rating')
        

        return $result;
    }




}
