
@extends('layouts/app')
@section('title', 'Home')

@section('content')

    <h1>Homepage</h1>

    <form action="{{ url('/search') }}" type="get">
        <select name="category" id="category">
            <option value="Collections">Collections</option>
            <option value="NFT's">NFT's</option>
        </select>
        <input class="form-control-lg" type="search" id="search" name="searchTerm" placeholder="Search"
            aria-label="Search">
        <button type="submit">Search </button>
    </form>

    @foreach ($nfts as $nft)
        <div>
            <a href="/nfts/{{ $nft->id }}">{{ $nft->title }}</a>




    <x-header firstname="{{ 'Jonathan' }}" />
    <h1>Homepage</h1>

    @foreach ($nfts as $nft)
        <div>
            <a href="/nfts/{{$nft->id}}">{{ $nft->title }}</a>

            {{-- add image --}}
        </div>
    @endforeach


    <script>
        var path = "{{ url('homepage/action') }}";



        $('#search').typeahead({


            source: function(query, process) {

                return $.get(path, {
                    term: query,
                    category: $("select#category").val()

                }, function(data) {
                    return process(data);

                });

            }

        });
    </script>


@endsection

