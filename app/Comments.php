<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Comments extends Model
{
  // Table Name
  protected $table = 'comments';
  // Primary Key
  protected $primaryKey = "comment_id";
  // No timestamps
  public $timestamps = false;

  public static function getComments($id)
  {
    $result = DB::table('comments')
    ->join('users', 'comments.user_id', 'users.user_id')
    ->where('car_id', $id)
    ->get();

    return $result;
  }

}
