<?php

namespace App\Http\Livewire;

use App\Models\NewComment;
use Livewire\Component;

class Comments extends Component
{

    public $nftId;
    public $userId;
    public $comment;
    public $data;

    

    public function render()
    {
        return view('livewire.comments');
    }
}
