<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Wallet;
use App\Models\Collection;




class walletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collections = \DB::table("collections")->get();
        $nfts = \DB::table("nfts")->get();
        $data["nfts"] = $nfts;
        $data["collections"] = $collections;
         return view('wallet/index', $data);
    }

}
