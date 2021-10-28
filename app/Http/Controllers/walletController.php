<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Wallet;
use App\Models\Collection;

use Illuminate\Support\Facades\Auth;


class walletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $collections = \DB::table("collections")->get();
        $nfts = \DB::table("nfts")->get();
        $data['user'] = $user;
        $data["nfts"] = $nfts;
        $data["collections"] = $collections;
         return view('wallet/index', $data);
    }

}
