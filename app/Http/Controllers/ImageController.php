<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function upload(Request $request){
        $path = $request->file('image')->store('uploads', 'public');
        return redirect()->back()->with('path', $path);
        //return redirect()->route($request -> last_route, ['path' => $path]);
        //return redirect(url()->previous())->with('path', $path);
        // return view($request-> view_name, compact('path'));
    }
}
?>