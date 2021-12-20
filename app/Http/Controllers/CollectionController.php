<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Collection;
use App\Models\Nft;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Gate;


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
            'collectionImage' => 'required|mimes:jpeg,jpg,png|max:500',
        ]);
        

        // $uploadedFileUrl = \Cloudinary::upload($request->file('collectionImage')->getRealPath())->getSecurePath();

        $image = $request->file('collectionImage');
            
        $token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VySW5mb3JtYXRpb24iOnsiaWQiOiJlODU4Y2FjNS0yNjQ4LTRmYzEtYmZlMC0wYWFiMDVjODM4N2EiLCJlbWFpbCI6ImpvbmF0aGFuX3ZlcmhhZWdlbkBob3RtYWlsLmNvbSIsImVtYWlsX3ZlcmlmaWVkIjp0cnVlLCJwaW5fcG9saWN5Ijp7InJlZ2lvbnMiOlt7ImlkIjoiRlJBMSIsImRlc2lyZWRSZXBsaWNhdGlvbkNvdW50IjoxfV0sInZlcnNpb24iOjF9LCJtZmFfZW5hYmxlZCI6ZmFsc2V9LCJhdXRoZW50aWNhdGlvblR5cGUiOiJzY29wZWRLZXkiLCJzY29wZWRLZXlLZXkiOiI1ODk3ZjdlNzI5YWY2MTI4MmEzMyIsInNjb3BlZEtleVNlY3JldCI6IjY0YjQ4YTQ5NDQwMTc5NTJjMzlmYzZkZTUxNzk1NjI3NjdkZjY2Mjg3N2RiMGZhYWU0Y2NjYTIzMzdkZGE2MTIiLCJpYXQiOjE2MzU5NTc4MDV9.gEhDh3rJNqr1rbUp6u4X6y_6kkUSxmBEipuoVjVdGFQ";
            
        $response = Http::withToken($token)->attach('attachment', file_get_contents($image))->post('https://api.pinata.cloud/pinning/pinFileToIPFS', ['file' => fopen($image, "r")]);


        $answer = json_decode($response);
        $filePath = "https://ipfs.io/ipfs/" . $answer->IpfsHash;
        
       
        $collection = new Collection();
        $collection->title = $request->input('collectionTitle');
        $collection->description = $request->input('collectionDescription');
        $collection->image_file_path = $filePath;
        $collection->creator_id = Auth::id();
        $collection->save();

        //add colection id when Nicolas made detailpage
        $request->session()->flash('message', 'Collection successfully created');


        return redirect("./collections/$collection->id");
    }

        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $collection = Collection::where('id', $id)->first();

        

        $data['user'] = $user;
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
        $collection = Collection::find($request->id);

        if ($request->user()->cannot('update', $collection)) {
            $collection_id = $request->id;
            $request->session()->flash('message', 'You cannot edit a collection that you do not own');
            return redirect("edit/$collection_id");
        }

        
        $validated = $request->validate([
            'collectionTitle' => 'required |unique:collections,title',
            'collectionDescription' => 'required'
        ]);
        
        $collection = Collection::find($request->id);
        $collection->title = $request->input('collectionTitle');
        $collection->description = $request->input('collectionDescription');
        $collection->save();

        $request->flash();
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

    public function showCollection($id){
        $collection = Collection::find($id);
        $nfts = Nft::get()->where('collection_id', $id);
        $user = Auth::user();
        $data["collection"] = $collection;
        $data["user"] = $user;
        $data["nfts"] = $nfts;
        
        return view('collection/showCollection', $data);

    }

}

