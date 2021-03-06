@extends('layouts.app')

@section('content')
<div class="container padding-top">
    <div class="row justify-content-center">
     @if(Route::has('login'))
  @auth
    @can('admin-only')
        <div class="col-md-8">
          <h1>Uppdatera bil</h1>
                {!! Form::open(['action' => ['AdminCarController@update', $carID] , 'method' => 'PUT']) !!}
            <div class="form-group">
                {!! Form::label('model', 'Bil modell') !!}
                {!! Form::text('model', null, array('placeholder'=>$model )) !!}
            </div>
            <div class="form-group">
                {!! Form::label('price_per_day', 'Dyngskostnad') !!}
                {!! Form::number('price_per_day', null, array('placeholder'=>$price_per_day )) !!}
            </div>
                <div class="form-group">
                {!! Form::label('seats', 'Antal säten') !!}
                {!! Form::number('seats', null, array('placeholder'=>$seats )) !!}
            </div>
            <div class="form-group">
                {!! Form::label('bhp', 'Hästkrafter') !!}
                {!! Form::number('bhp', null, array('placeholder'=>$bhp )) !!}
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

                {!! Form::submit('Uppdatera bil', ['class' => 'btn btn-success']) !!}

                {!! Form::close() !!}
        </div>
    @endcan
  @else
    <p>Åtkomst nekad!</p>
  @endauth
  @endif
    </div>
</div>
@endsection
