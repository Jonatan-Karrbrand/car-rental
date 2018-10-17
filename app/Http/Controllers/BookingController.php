<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Booking;
use App\Car;

class BookingController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = Booking::getAllBookings();
        return view('bookings.index')->with('bookings', $bookings);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('bookings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Calculate the difference between the booking in days
        $bookedFrom = strtotime($request->booked_from);
        $bookedTo = strtotime($request->booked_to);
        $difference = $bookedTo - $bookedFrom;
        $dateDifference = floor($difference/(60*60*24));
        // Plus at the end because I want to include price for the initial day aswell
        $totalPrice = $request->price_per_day * $dateDifference + $request->price_per_day;

        $this->validate($request, [
            'booked_from' => 'required',
            'booked_to' => 'required'
        ]);

        // The logged in users ID
        $userId = Auth::id();
        // If user is not logged in it will display an error message
        if ($userId == NULL) {
            echo 'Du måste vara inloggad för att genomföra en bokning.';
            return;
        } else {
            // Create Booking
            $booking = new Booking;
            $booking->car_id = $request->input('car_id');
            $booking->user_id = $userId;
            $booking->booked_from = $request->input('booked_from');
            $booking->booked_to = $request->input('booked_to');
            $booking->total_price = $totalPrice;
            $booking->save();
        }

      return back()->with('message', 'Du har nu bokat denna bil');
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
        //
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
        //
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

    public function private()
    {
        if (Gate::allows('admin-only', auth()->user())) {
            return view('booking.index');
        }
        return 'Du är inte en admin!';
    }

}
