@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>Kontouppgifter</h2>
            @foreach ( $userInformation as $userInfo )
                <h3>Användarnamn: {{ $userInfo->email }}</h3>
                <h3>Namn: {{ $userInfo->name }}</h3>
            @endforeach
            <br>
            <h2>Dina bokade bilar</h2>
            @foreach ( $userBookings as $userBooking )
                <hr>
                <h3>Bil: {{ $userBooking->model }}</h3>
                <h3>Bokad från: {{ $userBooking->booked_from }}</h3>
                <h3>Bokad till: {{ $userBooking->booked_to }}</h3>
                <h3>Toatalsumma: {{ $userBooking->total_price }}:-</h3>
                {!! Form::open(['action' => ['UserController@destroy', $userBooking->booking_id] , 'method' => 'POST']) !!}
                    {!! Form::hidden('_method', 'DELETE')!!}
                    {{Form::submit('Ta bort bokning', ['class' => 'btn btn-primary'])}}
                {!! Form::close() !!}
            @endforeach
            @if(session('message'))
                <p>{{session('message')}}</p>
            @endif
        </div>
    </div>
</div>
@endsection
