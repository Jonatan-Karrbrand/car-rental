@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
  @if(Route::has('login'))
  @auth
    @can('admin-only')
    <div class="col-md-8 padding-top">
      <h1>Alla Användare</h1>
      @if(session('message'))
        <p>{{session('message')}}</p>
      @endif
      @foreach ($users as $user)
        <div class="card" style="margin-bottom: 10px;">
          <div class="card-header"></div>
            <div class="card-body row">
              <div class="col-md-6">
              <h2>{{ $user->name}}</h2>
              {{$user->email}}
              <a class="btn btn-primary" href="{{ url('/admin/users/' . $user->user_id . '/edit')}}">Uppdatera</a>
                {!! Form::open(['action' => ['AdminUserController@destroy', $user->user_id] , 'method' => 'POST']) !!}
                {!! Form::hidden('_method', 'DELETE')!!}
                {{Form::submit('Delete', ['class' => 'btn btn-primary'])}}
              {!! Form::close() !!}
              </div>
            </div>
          </div>
          @endforeach
        </div>
    </div>
    {{ $users->links() }}
    @endcan
  @else
    <p>Åtkomst nekad!</p>
  @endauth
  @endif
  </div>
</div>
@endsection
