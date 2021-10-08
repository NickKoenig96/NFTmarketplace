<h1>wallet</h1>

<h2>Your collections (at the moment all collections)</h2>

@foreach ($collections as $collection)
    <div>
        <p>id = {{ $collection->id }}</p>
        <p>{{ $collection->title }}</p>
        <a href="delete/{{ $collection->id }}">DELETE</a>
        <a href="edit/{{ $collection->id }}">EDIT</a>

    </div>

@endforeach

<h2>Your NFT's (at the moment all NFT's)</h2>

@foreach ($nfts as $nft)
    <div>
        <p>id = {{ $nft->id }}</p>
        <p>{{ $nft->title }}</p>
        <a href="delete/nft/{{ $nft->id }}">DELETE</a>
        <a href="edit/nft/{{ $nft->id }}">EDIT</a>

    </div>

@endforeach
