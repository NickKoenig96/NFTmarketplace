<p>1 euro = {{ $eth }}ETH</p>

<h1>nft</h1>


@foreach ($nfts as $nft)
    <div>
        @if ($nft->creator == $user)
            <p>id = {{ $nft->id }}</p>
            <p>{{ $nft->title }}</p>
            <a href="">Mint this NFT</a>
            <p>price in EUR = {{ $nft->price }}</p>
            <p>price in ETH = {{ $eth * $nft->price }}</p>
        @elseif($nft->creator != $user && $nft->minted == 0)
            <p>id = {{ $nft->id }}</p>
            <p>{{ $nft->title }}</p>
            <p>This NFT has not been minted yet</p>
            <p>{{ $nft->price }}</p>
            <p>price in EUR = {{ $nft->price }}</p>
            <p>price in ETH = {{ $eth * $nft->price }}</p>
        @endif
        <br>
    </div>
@endforeach
