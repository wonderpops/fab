<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Car;
use App\Part;
use DB;

class CarController extends Controller
{
    public function index(){
        $cars = Car::newest();
        return view('cars.index', compact('cars'));
    }

    public function index_disassembling(){
        $cars = Car::disassembling();
        return view('cars.index', compact('cars'));
    }

    public function index_disassembled(){
        $cars = Car::disassembled();
        return view('cars.index', compact('cars'));
    }

    public function index_with_search_query(Request $request){
        $search_query = $request -> search_query;
        $cars = Car::newest();
        if ($search_query != '') {
            $results = array();
            foreach ($cars as $car) {
                $carr = $car -> getAttributes();
                foreach ($carr as $field){
                    if(mb_stristr($field, $search_query, false, 'UTF-8') !== FALSE) {
                        array_push($results, $car);
                        break;
                    }
                }
            }
            return view('cars.index', ['cars' => $results, 'search_query' => $search_query]);
        } else {
            return view('cars.index', ['cars' => $cars, 'search_query' => $search_query]);
        }
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
            'manufacture_year' => 'required|max:255',
            'valuation' => 'required|max:255',
            'body_code' => 'required|max:255',
            'body_color' => 'required|max:255',
            'interior_code' => 'required|max:255',
            'engine_code' => 'required|max:255',
            'gearbox_type' => 'required|max:255',
            'gearbox_code' => 'required|max:255',
            'status' => 'required|max:255'
        ]);

        $car = new Car;
        $car->name = $request -> name;
        $car->manufacture_year = $request -> manufacture_year;
        $car->valuation = $request -> valuation;
        $car->body_code = $request -> body_code;
        $car->body_color = $request -> body_color;
        $car->interior_code = $request -> interior_code;
        $car->engine_code = $request -> engine_code;
        $car->gearbox_type = $request -> gearbox_type;
        $car->gearbox_code = $request -> gearbox_code;
        $car->status = $request -> status;
        $car->image = $request -> image;

        $car->save();
        return redirect('/cars');
    }

    public function save_changes(Request $request){
        $validator = $request->validate([
            'name' => 'required|max:255',
            'manufacture_year' => 'required|max:255',
            'valuation' => 'required|max:255',
            'body_code' => 'required|max:255',
            'body_color' => 'required|max:255',
            'interior_code' => 'required|max:255',
            'engine_code' => 'required|max:255',
            'gearbox_type' => 'required|max:255',
            'gearbox_code' => 'required|max:255',
            'status' => 'required|max:255'
        ]);

        $car = Car::find($request -> car_id);

        $car->name = $request -> name;
        $car->manufacture_year = $request -> manufacture_year;
        $car->valuation = $request -> valuation;
        $car->body_code = $request -> body_code;
        $car->body_color = $request -> body_color;
        $car->interior_code = $request -> interior_code;
        $car->engine_code = $request -> engine_code;
        $car->gearbox_type = $request -> gearbox_type;
        $car->gearbox_code = $request -> gearbox_code;
        $car->status = $request -> status;

        $car->save();

        return redirect('/cars/'.$request -> car_id);
    }

    public function delete_car(Request $request){
        $car_id = $request -> car_id; 
        DB::table('cars')->where('id', '=', $car_id)->delete();
        DB::table('parts')->where('car_id', '=', $car_id)->delete();
        return redirect('/cars');
    }
}
