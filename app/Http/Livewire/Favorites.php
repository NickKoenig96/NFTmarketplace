<?php

namespace App\Http\Livewire;

use App\Models\Favourite;
use Livewire\Component;

class Favorites extends Component
{

    public $nftId;
    public $userId;
    public $liked;
    public $data;

    public function mount($nftId, $userId)
    {
        $this->nftId = $nftId;
        $this->userId = $userId;

        $this->data = \App\Models\Favourite::where('nft_id', $this->nftId)->first();

        // dd($this->data);
        if($this->data){
            $this->liked = true;
        }
        else{
            $this->liked = false;
        }
    }

    public function render()
    {
        return view('livewire.favorites');
    }

    public function favourite(){
        $createFavourite = Favourite::create(
            [
                'nft_id' => $this->nftId,
                'user_id' => $this->userId,
                'sentiment' => true
            ]
        );
        $this->liked = true;
    }

    public function unfavourite(){
        Favourite::where('user_id', $this->userId)
            ->where('nft_id', $this->nftId)->delete();
        
        $this->liked = false;
    }

    
}
