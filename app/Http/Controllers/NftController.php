<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Nft;
use App\Models\User;
use App\Models\Collection;
use App\Models\Favourite;
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

    public function profilepage(){
        $nfts = Nft::get();
        $data['nfts'] = $nfts;
        return view('profile', $data);
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
        $id = 4;
        $nfts = Nft::get();
        $collections = Collection::get();
        $user = Auth::user();
        $user = \DB::table("users")->where('id', $id)->first();
        $data["nfts"] = $nfts;
        $data["user"] = $user;
        $data["collections"] = $collections;
        // $favourites = Favourite::get();
        // dd($favourites->user_id);
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

    public function buyNft($id){
        $user = Auth::id();
        $nft = Nft::find($id);
        $data["nft"] = $nft;
        $data["user"] = $user;
        return view('nft/buyNft', $data );
    }

    public function Order(Request $request){
        //order toevoegen
        $order = new \App\Models\Order();
        $order->nft_id = $request->input('id');
        $order->price = $request->input('price');
        $order->seller_id = $request->input('seller');
        $order->buyer_id = $request->input('buyer');
        $order->save();
        

        //nft updaten
        $nft = Nft::find($request->input('id'));
        $nft->owner_id = $request->input('buyer');
        $nft->forSale = 0;
        $nft->save();

        return redirect('./nft');

    }

    public function sell($id){
        $nft = Nft::find($id);
        $data["nft"] = $nft;
        return view("nft/sellNft", $data);
    }

    public function markForSale(Request $request){
        $nft = Nft::find($request->input('id'));
        if($nft->owner_id === Auth::id()){
            $nft->forSale = 1;
            $nft->price = $request->input('price');
            $nft->save();
            return redirect('./nft');
        }
    }


    public function filter(Request $request){
        $filter = $request->input('filter');
        if($filter == 'Price'){
            $nfts = \DB::table("nfts")->select('id','price', 'title', 'image_file_path')->orderBy('price')->get();
            return view("/homepageFilter", compact("nfts"), compact("filter"));

        }else if($filter == 'Area'){
            $nfts = \DB::table("nfts")->select('id','area', 'title', 'image_file_path')->orderBy('area')->get();
            return view("/homepageFilter", compact("nfts"), compact("filter"));
        }
        else{
            $nfts = \DB::table("nfts")->select('id','object_type', 'title', 'image_file_path')->orderBy('object_type')->get();
            return view("/homepageFilter", compact("nfts"), compact("filter"));
        }
    }

  

}
