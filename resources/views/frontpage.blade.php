@extends('layouts.app')

@section('content')

<div class="hero-image">
  <div class="container">
    <div class="hero-text">
      <h1>Car rental</h1>
      <p>Hyr as feta bilar</p>
    </div>
  </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 frontpage-section-free-cars">
            <h2>LEDIGA BILAR IDAG</h2>
            <div class="row">

            @foreach ( $availableCars as $availableCar )
            <div class="col-xs-4 frontpage-column">
              <img class="img-300" src="{{$availableCar->image}}" alt="">
              <h4><a href="/cars/{{$availableCar->car_id}}">{{ $availableCar->model }}</a></h4>
              <p>Dygns kostnad {{ $availableCar->price_per_day }}Kr</p>
            </div>
            @endforeach

          </div>
          <div class="padding-top">
            <a href="/cars" class="btn btn-primary">Se fler</a>
          </div>
        </div>
    </div>
</div>
@endsection
