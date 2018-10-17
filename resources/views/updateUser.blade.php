@extends('layouts.app')

@section('content')
<div class="container padding-top">
    <div class="row justify-content-center">
     @if(Route::has('login'))
  @auth
    @can('admin-only')
        <div class="col-md-8">
          <h1>Uppdatera Användare</h1>
                {!! Form::open(['action' => ['AdminUserController@update', $user_id], 'method' => 'PUT']) !!}
            <div class="form-group">
                {!! Form::label('name', 'Användarnamn') !!}
                {!! Form::text('name', null, array('placeholder'=>$username )) !!}
            </div>
            <div class="form-group">
                {!! Form::label('email', 'E-mail') !!}
                {!! Form::email('email', null, array('placeholder'=>$email )) !!}
            </div>
                <div class="form-group">
                {!! Form::label('is_admin', 'Admin??') !!}
                {!! Form::select('is_admin', array(
                    '0' => 'nej',
                    '1' => 'ja'
                    )) !!}
            </div>
                {!! Form::submit('Uppdatera Användare', ['class' => 'btn btn-success']) !!}
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
