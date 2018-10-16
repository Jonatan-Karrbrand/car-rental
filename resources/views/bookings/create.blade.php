
@if (Auth::check())
  {!! Form::open(['action' => 'BookingController@store', 'method' => 'POST']) !!}
      {{Form::label('booked from', 'Från: ')}}
      {{Form::date('booked_from', \Carbon\Carbon::now())}}
      {{Form::label('booked to', 'Till: ')}}
      {{Form::date('booked_to', \Carbon\Carbon::now())}}

      {!! Form::hidden('car_id', $car->car_id) !!}
      {!! Form::hidden('price_per_day', $car->price_per_day) !!}

      {{Form::submit('Boka bil')}}
  {!! Form::close() !!}
@else
  <p>Du behöver logga in för att boka</p>
@endif

@if ($bookings)
  <p class="" >Bokade datum för denna bil<p>
  @foreach ( $bookings as $booking )
    @if ( $booking->car_id = $car->car_id)
    <p class="booked-text" >Från {{ $booking->booked_from }} till {{ $booking->booked_to }}</p>
    <hr>
    @endif
  @endforeach
@endif
