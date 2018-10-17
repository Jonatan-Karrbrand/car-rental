@extends('layouts.app')

@section('content')
<div class="container padding-top">
    <div class="row justify-content-center">
     @if(Route::has('login'))
  @auth
    @can('admin-only')
        <div class="col-md-8">
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
        </div>
    @endcan
  @else
    <p>Åtkomst nekad</p>
    <p>Ta mig till <a href="/frontpage">startsidan!</a></p>
  @endauth
  @endif
    </div>
</div>
@endsection
