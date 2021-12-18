<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Illuminate\Support\Carbon;
use Livewire\Component;

class NewComment extends Component
{
    public $nftId;
    public $userId;
    public $userFirstname;
    public $userLastname;
    public $data;
    public $newComment;
    public $commentId;
    public $comment;
    public $deleted = false;

    public $comments = [];
    

    public function addComment()
    {
        if(!empty($this->newComment))
        {
            array_unshift($this->comments, [
                'commentText' => $this->newComment,
                'created_at' => Carbon::now()->diffForHumans(),
                'user' => $this->userFirstname . ' ' . $this->userLastname
            ]);
            $this->storeComment();
            $this->comment = Comment::with('Nft', 'User')->where('nft_id', $this->nftId)->orderBy('id','desc')->first();
            $this->commentId = $this->comment->id;

            $this->newComment = "";
        }
    }

    public function storeComment()
    {
        $storeComment = Comment::create(
            [
                'nft_id' => $this->nftId,
                'user_id' => $this->userId,
                'text' => $this->newComment
            ]
        );
    }

    public function deleteNewComment()
    {
        Comment::where('id', $this->commentId)
            ->delete();
        $this->deleted = true;
    }

    public function mount($nftId, $userId, $userFirstname, $userLastname)
    {
        $this->nftId = $nftId;
        $this->userId = $userId;
        $this->userFirstname = $userFirstname;
        $this->userLastname = $userLastname;

        $this->data = \App\Models\Comment::where('nft_id', $this->nftId)->first();
        // dd($this->data);
    }

    public function render()
    {
        return view('livewire.new-comment');
    }
}
