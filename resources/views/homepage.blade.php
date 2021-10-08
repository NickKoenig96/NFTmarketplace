<h1>Homepage</h1>

@foreach ($nfts as $nft)
    <div>
        <a href="/nfts/{{$nft->id}}">{{ $nft->title }}</a>
        {{-- add image --}}
    </div>
@endforeach