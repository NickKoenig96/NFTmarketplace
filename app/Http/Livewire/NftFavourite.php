<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Nft;
use App\Models\Nft_user;
use Livewire\Component;
// use Illuminate\Support\Facades\Auth;


class NftFavourite extends Component
{
    // public $id;
    
    // public $favourite = false;
    // public $unfavourite = false;
    // public $data;
    // public $user;
    // public $nft;
    // public $count;

    // public function mount(Nft $nft){
    //     $this->nft = $nft;
    // }
   
   

    public function favourite(){
        // $id = 1;

        dd("click");
        // echo $id;
        // $user = Auth::user();
        // $userId = $user["id"];
        // $nftId = Nft::where('id')->get();
        // dd($nftId);

        // $this->count ++; 
        // dd($userId);
        // if (!$this->data) {
        //     $createfavourite = Nft_user::create(
        //         [
        //             'nft_id' => $this->nft,
        //             'user_id' => $this->user->id
        //         ]
        //     );
        // } else {
        //     $updatefavourite = Nft_user::where('user_id', $this->user->id)
        //         ->where('nft_id', $this->nft);
        // }
        // if(){

        // }

        // $id = 2;
        // $nft_id = Nft::where('id', $id)->first();
        // // // $nft_id = User::where("id", $id)->get();
        // // dd($nft_id);
        // $data['nfts'] = $nft_id;
        // dd($nft_id);
        // // $this->nfts = \App\Models\NftUser::insert([
        // //     'user_id' => $user_id, 'nft_id' => $nft_id
        // // ]);
        // return view('homepage', $data)->with('nfts', $nft_id);
    }

    public function render()
    {
        return view('livewire.nft-favourite');
    }
}
