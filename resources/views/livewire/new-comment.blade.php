<div>
    <form method="post" action="{{ url('/comment/store') }}">
        @csrf
        <div class="comment marginb-24 flex flex--start flex--gap40">
            <div class="form__control--80perc">
                <input type="text" id="comment" name="comment" placeholder="Your comment">
            </div>
            <input type="hidden" id="nft_id" name="nft_id" value="{{ $nft->id }}">
            <input type="hidden" id="user_id" name="user_id" value="{{ $user->id }}">
            <div class="form__control--smaller">
                <input  type="submit" value="Post">
            </div>
        </div>
    </form>
    
    <div class="comment" style="margin-bottom: 24px;">
        <p class="comment__user">Nico</p>
        <p class="comment__text">jow</p>
        <div class="comment__details flex flex--start flex--gap40">
            <p>Delete</p>
            <p>5min ago</p>
        </div>
    </div>    
</div>
