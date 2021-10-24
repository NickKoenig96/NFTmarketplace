<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Nft;
use App\Models\Collection;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;



class NftController extends Controller
{

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile(){
        $id = 4;
        $user = \DB::table("users")->where('id', $id)->first();
        $data['user'] = $user;
        return view('homepage', $data);
    }

    public function index(){
        
        $nfts = Nft::get();
        $user = Auth::id();
       // $nfts = \DB::table("nfts")->get();
        $data["nfts"] = $nfts;
        $data['user'] = $user;
        

         return view('nft/index', $data);
    }

    // nfts in homepage
    public function homepage(){
        $nfts = Nft::get();
        $user = Auth::user();
       // $nfts = \DB::table("nfts")->get();
        $data["nfts"] = $nfts;
        $data["user"] = $user;
         return view('homepage', $data);
    }

    // detail page from the homepage
    public function showAllNfts($id){
        // echo $id;
        $nft = Nft::where('id', $id)->first();
       // $nft = \DB::table('nfts')->where('id', $id)->first();
        // dd($nft);
        $data['nft'] = $nft;
        return view('nft/showAllNfts', $data);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Nft::find($id);
        $data->delete();
        return redirect('/wallet');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(){
        $data['user'] = 'Nick Koenig';
        $collections = Collection::get();
       // $collections = \DB::table("collections")->get();
        $data['collections'] = $collections;
        return view('nft/addNft', $data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        $image_file_path = $request->file('nftImage')->getClientOriginalName();
        $path = $request->file('nftImage')->storeAs('public/images/', $image_file_path );
      
       
        $nft = new Nft();
        $nft->creator = $request->input('creator');
        $nft->title = $request->input('nftTitle');
        $nft->description = $request->input('nftDescription');
        $nft->image_file_path = $image_file_path;
        $nft->collection_id = $request->input('collectionsId');
        $nft->save();
        return redirect('./nft');
    }

        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
        $nft = Nft::find($id);
        $data['nft'] = $nft;
        return view('nft/editNft', $data);

    }

            /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {

        $image_file_path = $request->file('nftImage')->getClientOriginalName();
        $path = $request->file('nftImage')->storeAs('public/images/', $image_file_path );

       
       $nft = Nft::find($request->id);
       $nft->title = $request->input('nftTitle');
       $nft->description = $request->input('nftDescription');
       $nft->image_file_path = $image_file_path;
       $nft->save();
        return redirect('./wallet');
    }

    public function buy(Request $request){
        
    }




  

}
