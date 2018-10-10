@extends('layouts.app')

@section('content')
<div class="container">


            @foreach ($cars as $car)

                <div class="row">

                  <div class="col-xs-6 single-car-col">
                    <img class="single-car-image" src="{{$car->image}}" alt="">
                  </div>

                  <div class="col-xs-6 single-car-col">
                    <h1>{{ $car->model }}</h1>
                    <ul>
                      <li>Biltyp: {{ $car->car_type }}</li>
                      <li>Växellåda: {{ $car->gearbox }}</li>
                      <li>Antal säten: {{ $car->seats }}</li>
                      <li>Antal hästkrafter: {{ $car->bhp }}</li>
                      <li>Avgift: {{ $car->price_per_day }}kr/dag</li>
                    </ul>
                  </div>

                </div>
                <div class="row">

                  <div style="padding: 15px;"class="col-xs-6">
                    <h2>Boka</h2>
                    @include('bookings.create')
                  </div>

                </div>
            @endforeach

</div>
@endsection
