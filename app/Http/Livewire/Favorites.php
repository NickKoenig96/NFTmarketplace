<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Favorites extends Component
{

    //public $favorite;
    public $nfts = [];
    public $nftId;

    public function mount($nftId)
    {
        $this->nftId = $nftId;
    }

    public function favorite($id){
        $this->nfts = \App\Models\Nft::where('id', 'LIKE', "%{$id}%")->get();

    }

    public function render()
    {
        return view('livewire.favorites');
    }
}
