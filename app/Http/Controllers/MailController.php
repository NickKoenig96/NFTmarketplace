<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


use App\Models\Nft;
use App\Models\User;


use App\Mail\nftSoldMail;

class MailController extends Controller
{

    public static function mail($nft){
    
      $user = User::find($nft->owner_id);
        
        $data = [
            'nft' => $nft,
            'user' =>  $user
        ];
        
        Mail::to($user->email)->send(new nftSoldMail($data));

    }

}
