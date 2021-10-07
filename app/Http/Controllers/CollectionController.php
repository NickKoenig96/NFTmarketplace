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

        $image_file_path = $request->file('collectionImage')->getClientOriginalName();
        $request->file('collectionImage')->store('public/images/');
       
        $collection = new Collection();
        $collection->title = $request->input('collectionTitle');
        $collection->description = $request->input('collectionDescription');
        $collection->image_file_path = $image_file_path;
        $collection->save();
        return redirect('./collection');
    }
}
