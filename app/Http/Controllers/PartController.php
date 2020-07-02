<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Car;
use App\Part;
use DB;

class PartController extends Controller
{
    public function index(){
        $parts = Part::newest();
        return view('parts.index', compact('parts'));
    }

    public function index_storage(){
        $parts = Part::on_storage();
        return view('parts.index', compact('parts'));
    }

    public function index_sold(){
        $parts = Part::sold();
        return view('parts.index', compact('parts'));
    }

    public function show($id){
        $part = Part::find($id);
        $car = Car::where('id', $part->car_id)->first();
        return view('parts.show', compact('part', 'car'));
    }

    public function prise_check($id){
        $part = Part::find($id);
        $car = Car::where('id', $part->car_id)->first();
        return view('parts.prise_check', compact('part', 'car'));
    }

    public function add($id = null){
        if (!is_null($id)){
            $car = Car::where('id', $id)->first();
            return view('parts.add', compact('car'));            
        }
        return view('parts.add');
    }

    public function index_with_search_query(Request $request){
        $search_query = $request -> search_query;
        $parts = Part::newest();
        if ($search_query != '') {
            $results = array();
            foreach ($parts as $part) {
                $partt = $part -> getAttributes();
                foreach ($partt as $field){
                    if(mb_stristr($field, $search_query, false, 'UTF-8') !== FALSE) {
                        array_push($results, $part);
                        break;
                    }
                }
            }
            return view('parts.index', ['parts' => $results, 'search_query' => $search_query]);
        } else {
            return view('parts.index', ['parts' => $parts, 'search_query' => $search_query]);
        }
    }

    public function save_changes(Request $request){
        $validator = $request->validate([
            'name' => 'required|max:255',
            'type' => 'required|max:255',
            'status' => 'required|max:255',
            'condition' => 'required|max:255',
            'originality' => 'required|max:255',
            'car_id' => 'required|max:255',
            'prise' => 'required|max:255'
        ]);

        $part = Part::find($request -> part_id);

        $part->name = $request -> name;
        $part->car_id = $request -> car_id;
        $part->type = $request -> type;
        $part->prise = $request -> prise;
        $part->status = $request -> status;
        $part->condition = $request -> condition;
        $part->originality = $request -> originality;

        $part->save();

        $part_id = $part -> id;
        $data = '';
        $type_data = $request -> type_data;

        foreach ($type_data as $key => $typ) {
            $key = substr($key,1,-1);
            $data .= $key." = '$typ', ";
        }

        $data = substr($data,0,-2);

        DB::statement("UPDATE $request->type SET $data WHERE part_id = $part_id");
        return redirect('/parts/'.$request -> part_id.'/main');
    }

    public function delete_part(Request $request){
        $part_id = $request -> part_id;
        $part_type = $request -> part_type; 
        DB::table('parts')->where('id', '=', $part_id)->delete();
        DB::table($part_type)->where('part_id', '=', $part_id)->delete();
        return redirect('/parts');
    }

    public function add_new_part(Request $request){
        $validator = $request->validate([
            'name' => 'required|max:255',
            'type' => 'required|max:255',
            'status' => 'required|max:255',
            'condition' => 'required|max:255',
            'originality' => 'required|max:255',
            'car_id' => 'required|max:255',
            'image' => 'required',
            'prise' => 'required|max:255'
        ]);
        
        $part = new Part;
        
        $part->name = $request -> name;
        $part->type = $request -> type;
        $part->prise = $request -> prise;
        $part->status = $request -> status;
        $part->condition = $request -> condition;
        $part->originality = $request -> originality;
        $part->car_id = $request -> car_id;
        $part->image = $request -> image;

        $part->save();

        $part_id = $part -> id;
        $data = "NULL, $part_id";
        $type_data = $request -> type_data;

        foreach ($type_data as $typ ){
            $data .= ", '".$typ."'";
        }

        DB::statement("INSERT INTO $request->type VALUES ($data)");
        return redirect('/parts');
    }

    public function add_type(){
        return view('parts.add_type');
    }
}
