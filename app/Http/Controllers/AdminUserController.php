<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\AdminUser;
use DB;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = AdminUser::getUsers();

        return view('adminUsers', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //hittar idt på användaren
        $id = AdminUser::find($id);
        //returnar viewn update och skickar med ett id som används i update funktionen
        //skickar med värdena som redan finns så dem används som placeholders i formuläret
        return view('updateUser', [
            'user_id' => $id,
            'username' => $id['name'],
            'email' => $id['email']
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //hittar idt på användaren
        $user = AdminUser::find($id);

        //kollar vilka fält som var i fylda ifrån updateUser.blade filen
        if($request['name'] !== null){
        $user->name = $request['name'];
        }
        if($request['email'] !== null){
            $user->email = $request['email'];
        }
        if($request['is_admin'] !== null){
            $user->is_admin = $request['is_admin'];
        }
        //skickar uppdateringen till databasen
        $user->save();

         //skickar tillbaks dig till /admin/users och medelar att det gick bra med uppdateringen
        return redirect()->action('AdminUserController@index')->with('message', 'Användate uppdaterades utan problem');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //hittar idt på användaren
        $user = AdminUser::find($id);
        //deletar användaren
        $user->delete();
        //redirectar din tillbaks till /admin/users
        return redirect('/admin/users')->with('message', 'Användaren borttagen');

    }
}
