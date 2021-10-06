<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Collection;

class CollectionController extends Controller
{
    public function create(){
        return view('collection/addColection');
    }

    public function store(Request $request){

       // dd($request->file());

        $image_file_path = $request->file('collectionImage')->getClientOriginalName();
        //dd($image_file_path);

        $request->file('collectionImage')->store('public/images');
        $collectionImage = new Collection();
        $collectionImage->title = 'imagetest';
        $collectionImage->description = 'imageTest';
        $collectionImage->image_file_path = $image_file_path;
        $collectionImage->save();
        return redirect()->back();
    }
}
