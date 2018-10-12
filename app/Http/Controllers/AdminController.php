<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\AdminOnly;

use App\Car;
use DB;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = AdminOnly::getCars();

        return view('adminCars', [
            'cars' => $cars
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validerar alla fält och medelar om något gick fel
        $this->validate($request, [
            'model' => 'required',
            'price_per_day' => 'required',
            'seats' => 'required',
            'bhp' => 'required',
            'car_type' => 'required',
            'gearbox' => 'required',
            'image' => 'required'

        ]);
        //hämtar tiden när man laddade upp filen och sätter filnamnet till det så att inte alla filer har samma namn.
        $carImage = time() . '.' . $request->image->getClientOriginalExtension();

        //tar filen och lägger den i images katalogen i public mappen. (om den inte skulle finnas så skapar den katalågen)
        $request->image->move(public_path('images'), $carImage);

        //sparar datan i tabellen cars i databasen
        $newCar = new AdminOnly;

        $newCar->model = $request['model'];
        $newCar->price_per_day = $request['price_per_day'];
        $newCar->seats = $request['seats'];
        $newCar->bhp = $request['bhp'];
        $newCar->car_type = $request['car_type'];
        $newCar->gearbox = $request['gearbox'];
        $newCar->image = 'images/' . $carImage;
        $newCar->save();

        //skickar tillbaks dig till /admin/create och medelar om det gick bra
        return back()->with('message', 'Bilen lades till utan problem');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //returnar viewn update och skickar med ett id som används i update funktionen
        return view('update', [
            'id' => $id
        ]);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //sparar datan i tabellen cars i databasen
        $uppdateCar = AdminOnly::find($request['car_id']);

        //sql querryn för uppdate
        $uppdateCar->model = $request['model'];
        $uppdateCar->price_per_day = $request['price_per_day'];
        $uppdateCar->seats = $request['seats'];
        $uppdateCar->bhp = $request['bhp'];
        $uppdateCar->car_type = $request['car_type'];
        $uppdateCar->gearbox = $request['gearbox'];
        $uppdateCar->save();


        //skickar tillbaks dig till /admin och medelar att det gick bra
        return redirect()->action('AdminController@index')->with('message', 'Bilen uppdaterades utan problem');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $car = Car::find($id);
      $car->delete();
      return redirect('/admin')->with('message', 'Bil borttagen');
    }

    public function private()
    {
        if (Gate::allows('admin-only', auth()->user())) {
            return view('create');
        }
        return 'Du är inte en admin!';
    }
}
