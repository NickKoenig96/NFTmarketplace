<h1>Homepage</h1>

@foreach ($nfts as $nft)
    <div>
        <p>{{ $nft->title }}</p>
        {{-- add image --}}
    </div>
@endforeach