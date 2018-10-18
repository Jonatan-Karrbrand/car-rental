@extends('layouts.app')

@section('content')
    @if (Route::has('login'))
        @auth
        @can('admin-only')
            @if(session('message'))
                <p>{{session('message')}}</p>
            @endif
            <h1>Alla bokningar</h1>
            @foreach ($bookings as $booking)
                <p>Användare som bokat: {{ $booking->email }}</p>
                <p>Bokad bil: {{ $booking->model }} (ID: {{ $booking->car_id }})</p>
                <p>Bokad från: {{ $booking->booked_from }}</p>
                <p>Bokad till: {{ $booking->booked_to }}</p>
                <p>Totalsumma för bokning: {{ $booking->total_price }}:-</p>

                {!! Form::open(['action' => ['BookingController@destroy', $booking->booking_id] , 'method' => 'POST']) !!}
                    {!! Form::hidden('_method', 'DELETE')!!}
                    {{Form::submit('Radera bokning', ['class' => 'btn btn-primary'])}}
                {!! Form::close() !!}
                <hr>
            @endforeach
        @endcan
    @else
        <p>Åtkomst nekad</p>
        <p>Ta mig till <a href="/frontpage">startsidan!</a></p>
        @endauth
    @endif
@endsection
