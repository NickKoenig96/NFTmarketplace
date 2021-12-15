<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Wallet;
use App\Models\Collection;
use App\Models\Nft;
use App\Models\User;


use Illuminate\Support\Facades\Http;



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
        $collections = Collection::get();
        $nfts = Nft::get();
        $data['user'] = $user;
        $data["nfts"] = $nfts;
        $data["collections"] = $collections;

         return view('wallet/index', $data);
    }

}
