<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function create()
    {
        return view('comments/create');
    }

    public function store(Request $request)
    {
        $comment = new Comment();
        $comment->text = $request->input('comment');
        $comment->nft_id = $request->input('nft_id');
        $comment->user_id = $request->input('user_id');
        $comment->save();
        return redirect('nfts/4');
    }
}
