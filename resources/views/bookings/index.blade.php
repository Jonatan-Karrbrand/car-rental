@extends('layouts.app')

@section('content')
<div class="container padding-top">
    <div class="row justify-content-center">
     @if(Route::has('login'))
     @auth
     @can('admin-only')
        <div class="col-md-8">
          <h1>Admin Bookningar</h1>
            @foreach ($bookings as $booking)
              <div class="card">
                <div class="card-body row">
                  <div class="col-md-10">
                    <h5>Användare som bokat: <strong>{{ $booking->email }}</strong></h5>
                    <ul>
                      <li>Bokad bil: {{ $booking->model }} (ID: {{ $booking->car_id }})</li>
                      <li>Bokad från: {{ $booking->booked_from }}</li>
                      <li>Bokad till: {{ $booking->booked_to }}</li>
                      <li>Totalsumma för bokning: {{ $booking->total_price }}:-</li>
                    </ul>

                    {!! Form::open(['action' => ['BookingController@destroy', $booking->booking_id] , 'method' => 'POST']) !!}
                        {!! Form::hidden('_method', 'DELETE')!!}
                        {{Form::submit('Radera bokning', ['class' => 'btn btn-primary'])}}
                    {!! Form::close() !!}
                  </div>
                </div>
              </div>
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
