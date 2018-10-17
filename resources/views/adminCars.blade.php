@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
  @if(Route::has('login'))
  @auth
    @can('admin-only')
    <div class="col-md-8 padding-top">
      <h1>Alla Bilar</h1>
      @if(session('message'))
        <p>{{session('message')}}</p>
      @endif
      @foreach ($cars as $car)
        <div class="card">
          <div class=""></div>
            <div class="card-body row less-padding">
              <div class="col-md-6 single-car-col">
                <img style="max-width: 200px;" src="{{asset($car->image)}}" alt="">
              </div>
              <div class="col-md-6 single-car-col">
                <h2><a href="/cars/{{$car->car_id}}">{{ $car->model}}</a></h2>

                <a class="btn btn-primary" href="{{ url('/admin/cars/' . $car->car_id . '/edit')}}">Uppdatera</a>
                  <div class="form-button">
                  {!! Form::open(['action' => ['AdminCarController@destroy', $car->car_id] , 'method' => 'POST']) !!}
                  {!! Form::hidden('_method', 'DELETE')!!}
                  {{Form::submit('Delete', ['class' => 'btn btn-primary'])}}
                  {!! Form::close() !!}
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
    </div>
    {{ $cars->links() }}
    @endcan
  @else
    <p>Åtkomst nekad!</p>
  @endauth
  @endif
  </div>
</div>
@endsection
