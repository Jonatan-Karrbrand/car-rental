
{!! Form::open(['action' => 'RatingController@store', 'method' => 'POST']) !!}
    {{Form::select('rating', array(
    "1" => "1",
    "2" => "2",
    "3" => "3",
    "4" => "4",
    "5" => "5"
    ))}}

    {!! Form::hidden('car_id', $car->car_id) !!}
    {{Form::submit('Betygsätt bil')}}
{!! Form::close() !!}
