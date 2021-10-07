<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageTest extends Controller
{
    public function create(){
        return view('/upload');
    }

    public function store(Request $request){

        dd($request);
    }

    public function destroy(Request $request){

        dd($request);
    }
}
