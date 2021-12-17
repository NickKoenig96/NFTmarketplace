<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Illuminate\Support\Carbon;
use Livewire\Component;

class AllComments extends Component
{
    public $nftId;
    public $userId;
    public $userFirstname;
    public $userLastname;
    public $deleted = false;

    public $comments = [];

    public function loadComments()
    {
        $this->comments = Comment::with('Nft', 'User')->where('nft_id', $this->nftId)->orderBy('id','desc')->get();
    }

    public function deleteComment($msg)
    {
        Comment::where('id', $msg)->delete();
        $this->deleted = true;
    }

    public function mount($nftId, $userId, $userFirstname, $userLastname)
    {
        $this->nftId = $nftId;
        $this->userId = $userId;
        $this->userFirstname = $userFirstname;
        $this->userLastname = $userLastname;

    }

    public function render()
    {
        return view('livewire.all-comments');
    }
}
