<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Car;
use App\Comments;
use App\Booking;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $result = $this->validate($request, [
        'seats' => '',
        'bhp' => '',
        'from' => '',
        'to' => '',
        'type' => '',
        'gearbox' => ''
      ]);

      $cars = Car::getAllCars($result);

      return view('cars', [
        'cars' => $cars
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
      //hämtar alla kommentarer, idt på en bil och alla bokningar
      $comments = Comments::getComments($id);
      $oneCar = Car::getOneCar($id);
      $bookings = Booking::getCarBookings($id);

      //retunerar car.blade med alla kommentarer och bokningar som tillhör just den bilen
      return view('car', [
        'cars' => $oneCar,
        'comments' => $comments,
        'bookings' => $bookings
      ]);
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
        //
    }
}
