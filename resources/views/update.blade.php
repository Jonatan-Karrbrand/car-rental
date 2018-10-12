@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @can('admin-only')
        <div class="col-md-8">
          <h1>Uppdatera bil</h1>
                {!! Form::open(['route' => 'Admin.store', 'enctype' => 'multipart/form-data']) !!}
            <div class="form-group">
                {!! Form::label('model', 'Bil modell') !!}
                {!! Form::text('model') !!}
            </div>
            <div class="form-group">
                {!! Form::label('price_per_day', 'Dyngskostnad') !!}
                {!! Form::number('price_per_day') !!}
            </div>
                <div class="form-group">
                {!! Form::label('seats', 'Antal säten') !!}
                {!! Form::number('seats') !!}
            </div>
            <div class="form-group">
                {!! Form::label('bhp', 'Hästkrafter') !!}
                {!! Form::number('bhp') !!}
            </div>    
            <div class="form-group">
                {!! Form::label('car_type', 'Bil typ') !!}
                {!! Form::select('car_type', array(
                    'Sedan' => 'Sedan',
                    'Coupé' => 'Coupé',
                    'Suv' => 'Suv',
                    'Cab' => 'Cab',
                    'Halvkombi' => 'Halvkombi',
                    'Kombi' => 'Kombi',
                    'Minibuss' => 'Minibuss'
                    )) !!}
            </div>
            <div class="form-group">
                {!! Form::label('gearbox', 'växellåda') !!}
                {!! Form::select('gearbox', array(
                    'Manuell' => 'Manuell',
                    'Automat' => 'Automat'
                    )) !!}
            </div>
            <div class="form-group">
                {!! Form::label('image', 'Bild på bilen') !!}
                {!! Form::file('image') !!}
            </div>

                {!! Form::submit('Uppdatera bil', ['class' => 'btn btn-success']) !!}

                {!! Form::close() !!}
        </div>
        @endcan
    </div>
</div>
@endsection
