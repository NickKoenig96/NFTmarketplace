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


    public function indexDetail(){
        $user = Auth::user();
        $collections = Collection::get();
       $data["collections"] = $collections;
       $data["user"] = $user;
        return view('collection/detailCollection', $data);
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

        $validated = $request->validate([
            'collectionTitle' => 'required |unique:collections,title',
            'collectionDescription' => 'required',
            'collectionImage' => 'required|image',
        ]);
        

        $uploadedFileUrl = \Cloudinary::upload($request->file('collectionImage')->getRealPath())->getSecurePath();
       
        $collection = new Collection();
        $collection->title = $request->input('collectionTitle');
        $collection->description = $request->input('collectionDescription');
        $collection->image_file_path = $uploadedFileUrl;
        $collection->creator_id = Auth::id();
        $collection->save();

        //add colection id when Nicolas made detailpage
        $request->session()->flash('message', 'Collection successfully created');


        return redirect('./collection/detailCollection');
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

        $validated = $request->validate([
            'collectionTitle' => 'required |unique:collections,title',
            'collectionDescription' => 'required',
            'collectionImage' => 'required|image',
        ]);

        $uploadedFileUrl = \Cloudinary::upload($request->file('collectionImage')->getRealPath())->getSecurePath();
       
        $collection = Collection::find($request->id);
        $collection->title = $request->input('collectionTitle');
        $collection->description = $request->input('collectionDescription');
        $collection->image_file_path = $uploadedFileUrl;
        $collection->save();

        $request->session()->flash('message', 'Collection successfully edited');

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

        session()->flash('message', 'Collection successfully deleted');

        return redirect('/wallet');
    }

}

