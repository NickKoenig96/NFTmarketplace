<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Nft;

use Illuminate\Support\Facades\Route;
use App\Mail\TestEmail;
use App\Mail\nftSoldMail;

use Illuminate\Mail\Mailable;

use Illuminate\Support\Facades\Mail;



class MailController extends Controller
{

    public static function mail($nft){
       
      // dd($nft);
        $data = [
            'message' => 'This is a test!',
            'nft' => $nft
        ];
        //$data = ['nft' => $id];
        //$test =$id;
    
        Mail::to('nick.koenig@mail.com')->send(new nftSoldMail($data));

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
