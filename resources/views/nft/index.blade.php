<p>1 euro = {{ $eth }}ETH</p>

<h1>nft</h1>
{{$user}}

@foreach ($nfts as $nft)
    <div>
        @if ($nft->owner_id == $user)
            <p>id = {{ $nft->id }}</p>
            <p>{{ $nft->title }}</p>
            <a href="">Mint this NFT</a>
            <p>price in EUR = {{ $nft->price }}</p>
            <p>price in ETH = {{ $eth * $nft->price }}</p>
            @if($nft->forSale === 0)
            <form method="POST" action="{{ url('/nft/markForSale') }}" enctype='multipart/form-data'>
            @csrf
                <input type="hidden" name="id" value="{{ $nft->id }}">
                <input type="submit" value="mark for sale">
            </form>
            @elseif($nft->forSale === 1)
            <p>This NFT is for sale</p>
            @endif
            
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
