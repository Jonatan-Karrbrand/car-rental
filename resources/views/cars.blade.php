@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          <h1>Bilar</h1>

          {!! Form::open(['action' => 'CarController@index', 'method' => 'GET']) !!}

            <div class="form-group">
              {{Form::label('seats', 'Minst antal säten')}}

              {{Form::select('seats',
                ['1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
                '6' => '6+',]
              )}}
            </div>
            <div class="form-group">
              {{Form::label('bhp', 'Hk')}}
              {{Form::text('bhp')}}
            </div>
            <div class="form-group">
              {{Form::date('from', \Carbon\Carbon::now())}}
              {{Form::date('to', \Carbon\Carbon::now())}}
            </div>

          {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
          {!! Form::close() !!}

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
                    <a href="/cars/{{$car->car_id}}">Mer info</a>
                  </div>

                </div>
            </div>
          @endforeach
        </div>
    </div>
    <div>
      {{$cars->links()}}
    </div>
</div>
@endsection
