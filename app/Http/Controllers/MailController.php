<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Nft;



class MailController extends Controller
{


    public static function mailData($id){

       //dd($id);

       $nft = Nft::find($id);
       $data["nft"] = $nft;
   // dd($data);

    return view('emails/nftSoldMail', $data);

    }
}
