@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          <h1>Alla Bilar</h1>
          @foreach ($cars as $car)
            <div class="card" style="margin-bottom: 10px;">
                <div class="card-header"></div>
                <div class="card-body row">
                  <div class="col-md-6">
                    <img style="max-width: 300px;" src="{{$car->image}}" alt="">
                  </div>

                  <div class="col-md-6">
                    <h2>{{ $car->model}}</h2>
                    Dygns kostnad: {{$car->price_per_day}}
                    <a class="btn btn-primary" href="{{ url('/admin/' . $car->car_id . '/edit')}}">Uppdatera</a>
                    {!! Form::open(['action' => ['AdminController@destroy', $car->car_id] , 'method' => 'POST']) !!}

                        {!! Form::hidden('_method', 'DELETE')!!}
                        {{Form::submit('Delete', ['class' => 'btn btn-primary'])}}
                    {!! Form::close() !!}

                  </div>

                </div>
            </div>
          @endforeach
        </div>
    </div>


  </div>
</div>
@endsection
