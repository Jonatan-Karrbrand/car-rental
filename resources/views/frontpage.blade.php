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
        <div class="col-md-8">
            <h1>LEDIGA BILAR IDAG</h1>
            @foreach ( $availableCars as $availableCar )
                <p>{{ $availableCar->model }}</p>
                <p>{{ $availableCar->price_per_day }}</p>
            @endforeach
        </div>
    </div>
</div>
@endsection
