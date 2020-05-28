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
        return view('part.show', compact('part'));
    }
}
