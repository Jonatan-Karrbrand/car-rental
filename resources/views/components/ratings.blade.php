@if($notVoted)
    {!! Form::open(['action' => 'CarController@store', 'method' => 'POST']) !!}
        {!! Form::label('rating', 'Betyg') !!}
        {!! Form::select('rating', array(
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                        '5' => '5'
                        )) !!}
        {!! Form::hidden('car_id', $car->car_id) !!}
        {{Form::submit('Rösta', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endif
