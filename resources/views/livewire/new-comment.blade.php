<div>
    <form>
        @csrf
        <div class="comment marginb-24 flex flex--start flex--gap40">
            <div class="form__control--80perc">
                <input type="text" id="comment" name="comment" placeholder="Your comment" wire:model="newComment">
            </div>
            <input type="hidden" id="nft_id" name="nft_id" value="{{ $nftId }}">
            <input type="hidden" id="user_id" name="user_id" value="{{ $userId }}">
            <div class="form__control--smaller">
                <input id="commentBtn" wire:click="addComment" type="submit" value="Post">
            </div>
        </div>
    </form>

    @foreach($comments as $comment)
    <div class="comment" style="margin-bottom: 24px;">
        <p class="comment__user">{{ $comment['user'] }}</p>
        <p class="comment__text">{{ $comment['commentText'] }}</p>
        <div class="comment__details flex flex--start flex--gap40">
            <p>Delete</p>
            <p>{{ $comment['created_at'] }}</p>
        </div>
    </div>   
    @endforeach

</div>

<script>
    let btn = document.querySelector('#commentBtn');

    btn.addEventListener('click', (e)=>{
        e.preventDefault();
    });
</script>