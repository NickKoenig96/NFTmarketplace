<p>current ETH price in EUR = {{ $eth }}</p>

<h1>nft</h1>


@foreach ($nfts as $nft)
    <div>
        @if ($nft->creator == $user)
            <p>id = {{ $nft->id }}</p>
            <p>{{ $nft->title }}</p>
            <a href="">Mint this NFT</a>
        @elseif($nft->creator != $user && $nft->minted == 0)
            <p>id = {{ $nft->id }}</p>
            <p>{{ $nft->title }}</p>
            <p>This NFT has not been minted yet</p>
        @endif
        <br>
    </div>
@endforeach
