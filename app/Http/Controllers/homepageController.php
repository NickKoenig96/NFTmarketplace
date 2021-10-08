<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class homepageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(/*\App\Models\Collection $collections*/){
        
        $Nft = \DB::table("nfts")->get();
        // dd($Nft);
        $data["nfts"] = $Nft;
         return view('homepage', $data);
    }


    public function show($id){
        echo $id;
        // $Nft = \DB::table("nfts")->get();
        // // dd($Nft);
        // $data["nfts"] = $Nft;
        //  return view('homepage', $data);
    }
}

