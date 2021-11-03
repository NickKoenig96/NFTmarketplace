<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Collection;
use Illuminate\Support\Facades\Auth;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $user = Auth::user();
        $collections = Collection::get();
       //$collections = \DB::table("collections")->get();
       $data["collections"] = $collections;
       $data["user"] = $user;
        return view('collection/index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(){
        $user = Auth::user();
        $data["user"] = $user;
        return view('collection/addCollection', $data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        

        $uploadedFileUrl = \Cloudinary::upload($request->file('collectionImage')->getRealPath())->getSecurePath();
       
        $collection = new Collection();
        $collection->title = $request->input('collectionTitle');
        $collection->description = $request->input('collectionDescription');
        $collection->image_file_path = $uploadedFileUrl;
        $collection->creator_id = Auth::id();
        $collection->save();
        return redirect('./collection');
    }

        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $collection = Collection::find($id);
        $data['collection'] = $collection;
        return view('collection/editCollection', $data);

    }


        /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {

        $uploadedFileUrl = \Cloudinary::upload($request->file('collectionImage')->getRealPath())->getSecurePath();
       
        $collection = Collection::find($request->id);
        $collection->title = $request->input('collectionTitle');
        $collection->description = $request->input('collectionDescription');
        $collection->image_file_path = $uploadedFileUrl;
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

    public function showCollection($id){
        $collection = Collection::find($id);
        $user = Auth::user();
        $data["collection"] = $collection;
        $data["user"] = $user;
        
        return view('collection/showCollection', $data);

    }

}

