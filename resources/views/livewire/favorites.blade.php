<div>


    <p wire:click="favorite({{ $id = 30 }})" wire:model="favorite" value="30">add favorite</p>



    <br>
    @foreach ($nfts as $nft)
        <p>{{ $nft->title }}</p>
    @endforeach
</div>
