<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Collection;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(/*\App\Models\Collection $collections*/){
        
       $collections = \DB::table("collections")->get();
       $data["collections"] = $collections;
        return view('collection/index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(){
        return view('collection/addCollection');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

