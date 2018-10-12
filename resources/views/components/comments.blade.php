{!! Form::open(['action' => 'CommentsController@store', 'method' => 'POST']) !!}
    {{Form::textarea('comment', null, ['rows' => '4'])}}

    {!! Form::hidden('car_id', $car->car_id) !!}
    {{Form::submit('Kommentera', ['class' => 'btn btn-primary'])}}
{!! Form::close() !!}
