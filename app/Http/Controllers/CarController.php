<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Car;
use App\Part;

class CarController extends Controller
{
    public function index(){
        $cars = Car::all();
        return view('cars.index', compact('cars'));
    }

    public function show($id){
        $car = Car::find($id);
        $parts = Part::where('car_id', $id)->get();
        return view('cars.show', compact('car', 'parts'));
    }
}
