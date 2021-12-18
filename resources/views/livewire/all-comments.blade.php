<div wire:init="loadComments">
    <ul>
        @foreach ($comments as $comment)
            <li class="comment">
                <p class="comment__user">{{ $comment->user->firstname . " " . $comment->user->lastname}}</p>
                <p class="comment__text">{{ $comment->text }}</p>
                <div class="comment__details flex flex--start flex--gap40">
                    @if($userId == $comment->user->id)
                        <p style="cursor: pointer;" wire:click="deleteComment({{ $comment->id }})">Delete</p>
                    @endif
                </div>
            </li>
        @endforeach
    </ul>
</div>
