<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Part;

class PartController extends Controller
{
    public function index(){
        $parts = Part::all();
        return view('parts.index', compact('parts'));
    }

    public function show($id){
        $part = part::find($id);
        return view('parts.show', compact('part'));
    }

    public function add(){
        return view('parts.add');
    }

    public function save_changes(Request $request){
        $validator = $request->validate([
            'name' => 'required|max:255',
            'type' => 'required|max:255',
            'cost' => 'required|max:255'
        ]);

        $part = Part::find($request -> part_id);
        $part->name = $request -> name;
        $part->type = $request -> type;
        $part->cost = $request -> cost;
        $part->status = $request -> status;
        //$part->status = 'Разбирается';
        $part->save();
        return redirect('/parts/'.$request -> part_id);
    }

    public function add_new_part(Request $request){
        $validator = $request->validate([
            'name' => 'required|max:255',
            'type' => 'required|max:255',
            'status' => 'required|max:255',
            'car_id' => 'required|max:255',
            'image' => 'required',
            'cost' => 'required|max:255'
        ]);

        $part = new Part;
        $part->name = $request -> name;
        $part->type = $request -> type;
        $part->cost = $request -> cost;
        $part->status = $request -> status;
        $part->car_id = $request -> car_id;
        $part->image = $request -> image;
        $part->save();
        return redirect('/parts');
    }
}
