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

        /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {

        $image_file_path = $request->file('collectionImage')->getClientOriginalName();
        $request->file('collectionImage')->store('public/images/');
       
        $collection = Collection::find($request->id);
        $collection->title = $request->input('collectionTitle');
        $collection->description = $request->input('collectionDescription');
        $collection->image_file_path = $image_file_path;
        $collection->save();
        return redirect('./wallet');
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Collection::find($id);
        $data->delete();
        return redirect('/wallet');
    }

}

