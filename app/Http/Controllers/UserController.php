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
        $userInformation = CarUser::getUser($id);
        $userBookings = CarUser::getUserBookings($id);
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
        $booking = Booking::find($id);
        $booking->delete();
        return back()->with('message', 'Bokning borttagen');
    }
}
