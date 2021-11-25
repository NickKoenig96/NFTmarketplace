<?php

namespace App\Http\Livewire;

use Livewire\Component;

class NewComment extends Component
{
    public $newComment;

    public function render()
    {
        return view('livewire.new-comment');
    }
}
