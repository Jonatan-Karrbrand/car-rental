@extends('layouts.app')

@section('content')
<div class="container">


            @foreach ($cars as $car)
            @if(session('message'))
              <h2 class="success-message">{{session('message')}}</h2>
            @endif
                <div class="row">

                  <div class="col-xs-6 single-car-col">
                      <img style="max-width: 500px;" src="{{$car->image}}" alt="">
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

                  <div class="col-xs-6 single-car-col">
                    <h2>Boka</h2>
                    @include('bookings.create')
                  </div>
                  <div class="col-xs-6 single-car-col">
                    <h2>Kommentarer</h2>
                    @if (Auth::check())
                      @include('components.comments')
                    @else
                      <p>Du behöver logga in för att kommentera</p>
                    @endif

                    <div class="">
                      @foreach ($comments as $comment)
                        <div class="card">
                            <div class="card-header">{{$comment->name}}</div>
                            <div class="card-body row">

                              <div class="col-md-6 single-car-column">
                                <img style="max-width: 300px;" src="{{$car->car_id, $car->image}}" alt="">
                              </div>

                              <div class="col-md-6">

                                {{$comment->comment}}
                              </div>

                            </div>
                        </div>
                      @endforeach
                    </div>
                  </div>

                </div>
            @endforeach

</div>
@endsection
