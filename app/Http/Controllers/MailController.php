<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Nft;
use App\Models\User;


use Illuminate\Support\Facades\Route;
use App\Mail\TestEmail;
use App\Mail\nftSoldMail;

use Illuminate\Mail\Mailable;

use Illuminate\Support\Facades\Mail;



class MailController extends Controller
{

    public static function mail($nft){

      //$user = User::where("id", $nft->owner_id)->get();
      $user = User::find($nft->owner_id);

      //dd($user->email);

      // dd($nft);
        $data = [
            'nft' => $nft,
            'user' =>  $user
        ];
        //$data = ['nft' => $id];
        //$test =$id;

       // dd($user);

    
        Mail::to($user->email)->send(new nftSoldMail($data));

       // return redirect('wallet');
    }


  /*  public static function mailData($id){

       //dd($id);

       $nft = Nft::find($id);
       $data["nft"] = $nft;
   // dd($data);

    return view('/emails/nftSoldMail', $data);

    }*/
}
