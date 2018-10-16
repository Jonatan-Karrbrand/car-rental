<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class AdminUser extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    public $timestamps = false;

    public static function getUsers()
    {
        $users = DB::table('users')
            ->paginate(100);

        return $users;
    }
}
