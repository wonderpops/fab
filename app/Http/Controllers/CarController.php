<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Car;
use App\Part;

class CarController extends Controller
{
    public function index(){
        $cars = Car::newest();
        return view('cars.index', compact('cars'));
    }

    public function show($id){
        $car = Car::find($id);
        $parts = Part::where('car_id', $id)->get();
        return view('cars.show', compact('car', 'parts'));
    }

    public function add(){
        return view('cars.add');
    }

    public function add_new_car(Request $request){
        $validator = $request->validate([
            'name' => 'required|max:255',
            'vin' => 'required|max:255'
        ]);

        $car = new Car;
        $car->name = $request -> name;
        $car->vin = $request -> vin;
        $car->status = 'Разбирается';
        $car->image = $request -> image;
        $car->save();
        return redirect('/cars');
    }

    public function save_changes(Request $request){
        $validator = $request->validate([
            'name' => 'required|max:255',
            'vin' => 'required|max:255'
        ]);

        $car = Car::find($request -> car_id);
        $car->name = $request -> name;
        $car->vin = $request -> vin;
        $car->status = 'Разбирается';
        $car->save();
        return redirect('/cars/'.$request -> car_id);
    }
}
