<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CarUser;
use App\Booking;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //hämtar användar information ifrån en användare och alla bokningar som den användaren gjort 
        $userInformation = CarUser::getUser($id);
        $userBookings = CarUser::getUserBookings($id);
        //reutnerar user.blade och listar användar informationen och alla bokningar
        return view('user')->with('userInformation', $userInformation)->with('userBookings', $userBookings);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //hämtar idt för en bokning och tar bort den bokningen ifrån databasen
        $booking = Booking::find($id);
        $booking->delete();
        return back()->with('message', 'Bokning borttagen');
    }
}
