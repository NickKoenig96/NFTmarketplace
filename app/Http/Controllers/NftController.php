<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Nft;


class NftController extends Controller
{

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        
        $nfts = \DB::table("nfts")->get();
        $data["nfts"] = $nfts;
         return view('nft/index', $data);
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
        return view('nft/addNft');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

      
       
        $nft = new Nft();
        $nft->title = $request->input('nftTitle');
        $nft->description = $request->input('nftDescription');
        $nft->collection_id = $request->input('collection_id');
        $nft->save();
        return redirect('./nft');
    }

}
