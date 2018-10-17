@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 padding-top">
            @if(session('message'))
                <h2 class="success-message">{{session('message')}}</h2>
            @endif
            <h3>Kontouppgifter</h3>
            @foreach ( $userInformation as $userInfo )
                <p>Användarnamn: {{ $userInfo->email }}</p>
                <p>Namn: {{ $userInfo->name }}</p>
            @endforeach
            <br>
            <h3>Dina bokade bilar</h3>
            @foreach ( $userBookings as $userBooking )
                <hr>
                <h4>{{ $userBooking->model }}</h4>
                <li>Bokad från: {{ $userBooking->booked_from }}</li>
                <li>Bokad till: {{ $userBooking->booked_to }}</li>
                <li>Totalsumma: {{ $userBooking->total_price }}:-</li>
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
