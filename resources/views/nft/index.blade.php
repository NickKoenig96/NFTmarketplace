<h1>nft</h1>
@foreach ($nfts as $nft)
    <div>
        <p>id = {{ $nft->id }}</p>
        <p>{{ $nft->title }}</p>


    </div>

@endforeach
