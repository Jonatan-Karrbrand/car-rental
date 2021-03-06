<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\AdminCar;
use App\Car;
use DB;


class AdminCarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //kör funktionen getCars som listar alla bilar
        $cars = AdminCar::getCars();

        //returnerar adminCars.blade som listar alla bilar som finns i databasen
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
        //retunerar createCar.blade
        return view('createCar');
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

        //hämtar tiden när man laddade upp filen och sätter filnamnet till det så inga filer har samma namn.
        $carImage = time() . '.' . $request->image->getClientOriginalExtension();

        //tar filen och lägger den i images katalogen i public mappen. (om den inte skulle finnas så skapar den katalågen)
        $request->image->move(public_path('images'), $carImage);

        //lägger in all data i rätt kolumn och skickar det till databasen
        $newCar = new AdminCar;
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
        //hämtar idt
        $car = AdminCar::find($id);

        //returnar viewn update och skickar med ett id som används i update funktionen
        //skickar med värdena som redan finns så dem används som placeholders i formuläret
        return view('updateCar', [
            'carID' => $id,
            'model' => $car['model'],
            'price_per_day' => $car['price_per_day'],
            'seats' => $car['seats'],
            'bhp' => $car['bhp']
        ]);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //hämtar den idt på bilen
        $uppdateCar = AdminCar::find($id);

        //sql querryn för uppdate
        //kollar om alla värdena är satta och om dem inte är det så används dem inte i uppdate querryn
        if($request['model'] !== null){
            $uppdateCar->model = $request['model'];
        }
        if($request['price_per_day'] !== null){
            $uppdateCar->price_per_day = $request['price_per_day'];
        }
        if($request['seats'] !== null){
            $uppdateCar->seats = $request['seats'];
        }
        if($request['bhp'] !== null){
            $uppdateCar->bhp = $request['bhp'];
        }
        if($request['car_type'] !== null){
            $uppdateCar->car_type = $request['car_type'];
        }
        if($request['geatbox'] !== null){
            $uppdateCar->gearbox = $request['gearbox'];
        }
//        if($carImage !== null){
  //      $uppdateCar->image = 'images/' . $carImage;
    //    }

        //kör uppdate querryn
        $uppdateCar->save();

        //skickar tillbaks dig till /admin/cars och medelar att det gick bra
        return redirect()->action('AdminCarController@index')->with('message', 'Bilen uppdaterades utan problem');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $user = Car::find($id);
      $user->delete();
      return redirect('/admin/cars')->with('message', 'Bil borttagen');
    }

    public function private()
    {
        //kollar om man är admin och om man är det så retuneras createCar viewn eller så får man ett medelande att man inte är admin
        if (Gate::allows('admin-only', auth()->user())) {
            return view('createCar');
        }
        return 'Du är inte en admin!';
    }
}
