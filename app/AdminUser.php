<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class AdminUser extends Model
{
    //tabell namnet i databasen
    protected $table = 'users';
    //primary key
    protected $primaryKey = 'user_id';
    //sätter timestamps till false
    public $timestamps = false;

    public static function getUsers()
    {
        //hämtar alla bilar ifrån cars tabellen och listar 20 bilar på en sida
        $users = DB::table('users')
            ->paginate(100);

        return $users;
    }
}
