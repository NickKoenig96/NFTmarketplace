<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Nft;
use Livewire\Component;

class NftFavourite extends Component
{
    public $favourite;
   

    public function favourite($nft_id, $user_id){
        // $nft_id = Nft::where("id", $id)->get();
        // $nft_id = User::where("id", $id)->get();
        $this->nfts = \App\Models\NftUser::insert([
            'user_id' => $user_id, 'nft_id' => $nft_id
        ]);
    }

    public function render()
    {
        return view('livewire.nft-favourite');
    }
}
