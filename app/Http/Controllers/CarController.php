<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Car;
use App\Comments;
use App\Booking;
use App\Ratings;

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
        // The logged in users ID
        $userId = Auth::id();

        //kollar om det var comment som skickades med i requesten
        if(isset($request['comment'])){
            //validerar komentaren
            $this->validate($request, [
                'comment' => 'required'
            ]);

            //skapar querryn för en komentar och sparar den i databasen
            $comment = new Comments;
            $comment->car_id = $request->input('car_id');
            $comment->user_id = $userId;
            $comment->timestamp = '2018-10-03 11:50:10';
            $comment->comment = $request->input('comment');
            $comment->save();
        }

        //kollar om det var rating som skickades med i requesten
        if(isset($request['rating'])){
                //skapar querryn för en rating och sparar den i databasen
                $rating = new Ratings;
                $rating->user_id = $userId;
                $rating->car_id = $request->input('car_id');
                $rating->rating = $request->input('rating');
                $rating->save();
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      //hämtar alla kommentarer, idt på en bil och alla bokningar och hämtar ratingen på bilen
      $comments = Comments::getComments($id);
      $oneCar = Car::getOneCar($id);
      $bookings = Booking::getAllBookings($id);
      $rating = round(Ratings::getRating($id), 1, PHP_ROUND_HALF_UP);
      //hämtar användar idt som tillhör en bil med rating
      $userVoted = Ratings::getUserVoted($id);
      $userId = Auth::id();
      $notVoted = true;

      //kollar om användaren har röstat på bilen
      if($userVoted !== null){
          if($userVoted->user_id == $userId){
              $notVoted = false;
            }
        }
      //retunerar car.blade med alla kommentarer och bokningar som tillhör just den bilen
      return view('car', [
        'cars' => $oneCar,
        'comments' => $comments,
        'bookings' => $bookings,
        'rating' => $rating,
        'notVoted' => $notVoted
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
