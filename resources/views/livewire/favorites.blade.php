<div>

    <p wire:click="favorite({{ $nftId }})" wire:model="favorite">add favorite</p>




    <br>
    @foreach ($nfts as $nft)
        <p>{{ $nft->title }}</p>
    @endforeach
</div>
