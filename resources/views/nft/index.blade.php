<h1>nft</h1>
@foreach ($nfts as $nft)
    <div>
        <p>id = {{ $nft->id }}</p>
        <p>{{ $nft->title }}</p>
        @if ($user = $nft->creator)
            <a href=""> Mint this NFT</a>
    </div>
@endif
@endforeach
