@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          <h1>Bilar</h1>

        <form class="" action="CarController.php" method="post">
          <input type="text" name="seats">
          <input type="submit" name="submit" value="sök">
        </form>

          @foreach ($cars as $car)
            <div class="card" style="margin-bottom: 10px;">
                <div class="card-header"></div>
                <div class="card-body row">

                  <div class="col-md-6">
                    <img style="max-width: 300px;" src="{{$car->image}}" alt="">
                  </div>

                  <div class="col-md-6">

                    <h2>{{ $car->model}}</h2>
                    Dygns kostnad: {{$car->price_per_day}}
                    <a href="/cars/{{$car->car_id}}">Mer info</a>
                  </div>

                </div>
            </div>
          @endforeach
        </div>
    </div>
    <div>
      {{$cars->links()}}
    </div>
</div>
@endsection
