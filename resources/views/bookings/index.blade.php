@extends('layouts.app')

@section('content')
    @if (Route::has('login'))
        @auth
        @can('admin-only')
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
        @endcan
    @else
        <p>Åtkomst nekad</p>
        <p>Ta mig till <a href="/frontpage">startsidan!</a></p>
        @endauth
    @endif
@endsection