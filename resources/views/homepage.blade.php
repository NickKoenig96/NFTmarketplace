<h1>Homepage</h1>

<form action="{{ url('/search') }}" type="get">
    <input type="search" name="searchTerm" placeholder="Search" aria-label="Search">
    <button type="submit">Search </button>
</form>

@foreach ($nfts as $nft)
    <div>
        <a href="/nfts/{{ $nft->id }}">{{ $nft->title }}</a>
        {{-- add image --}}
    </div>
@endforeach
