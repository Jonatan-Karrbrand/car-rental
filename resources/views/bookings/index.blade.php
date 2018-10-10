@extends('layouts.app')

@section('content')
    <h1>Bookings</h1>
    @foreach ($bookings as $booking) 
        <p>Användare som bokat: {{ $booking->email }}</p>
        <p>Bokad bil: {{ $booking->model }} (ID: {{ $booking->car_id }})</p>
        <p>Bokad från: {{ $booking->booked_from }}</p>
        <p>Bokad till: {{ $booking->booked_to }}</p>
        <p>Boknadens kostnad: {{ $booking->total_price }}</p>
        <p>Totalsumma för bokning: {{ $booking->timestamp }}</p> 
        <hr>
    @endforeach 
@endsection