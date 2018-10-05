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
                <form action="car.blade.php" method="POST">
                    <label>Från:</label>
                    <input type="date" name="from" min="<?php echo date("Y-m-d"); ?>"><br>
                    <label>Till:</label>
                    <input type="date" name="to" min="<?php echo date("Y-m-d", strtotime("+1 day")); ?>"><br>
                    <input class="btn btn-primary" type="submit" value="Boka">
                <form>
                {!! Form::open(['action' => 'controller']) !!}

                {!! Form::close() !!}
            @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
