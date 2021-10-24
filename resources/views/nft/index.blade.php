<p>1 euro = {{ $eth }}ETH</p>

<h1>nft</h1>
{{$user}}

@foreach ($nfts as $nft)
    <div>
        @if ($nft->user_id == $user)
            <p>id = {{ $nft->id }}</p>
            <p>{{ $nft->title }}</p>
            <a href="">Mint this NFT</a>
            <p>price in EUR = {{ $nft->price }}</p>
            <p>price in ETH = {{ $eth * $nft->price }}</p>
            <a href="">Mark for sale</a>
        @elseif($nft->creator != $user && $nft->minted == 0 && $nft->forsale == 0) 
            <p>id = {{ $nft->id }}</p>
            <p>{{ $nft->title }}</p>
            <p>This NFT has not been minted yet</p>
            <p>{{ $nft->price }}</p>
            <p>price in EUR = {{ $nft->price }}</p>
            <p>price in ETH = {{ $eth * $nft->price }}</p>
            @if($nft->forSale === 0)
            <p>This NFT is not for sale right now</p>
            @elseif($nft->forSale === 1)
            <a href="/nft/buy/{{ $nft->id }}">Buy this NFT</a>
            @endif
        @endif
        <br>
    </div>
@endforeach
