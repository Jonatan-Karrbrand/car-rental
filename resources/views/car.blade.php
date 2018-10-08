@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            @foreach ($cars as $car)
                <div class="card-header">{{ $car->model }}</div>
                <div class="card-body">
                    <p>{{ $car->image }}</p>
                    <p>Biltyp: {{ $car->car_type }}</p>
                    <p>Växellåda: {{ $car->gearbox }}</p>
                    <p>Antal säten: {{ $car->seats }}</p>
                    <p>Antal hästkrafter: {{ $car->bhp }}</p>
                    <p>Avgift: {{ $car->price_per_day }}kr/dag</p>
                </div>
            @endforeach
                {!! Form::open(['action' => 'CarController@store', 'method' => 'POST']) !!}
                    {{Form::label('Från: ')}}
                    {{Form::date('from', \Carbon\Carbon::now())}}
                    {{Form::label('Till: ')}}
                    {{Form::date('to', \Carbon\Carbon::now())}}
                    {{Form::submit('Boka bil')}}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
