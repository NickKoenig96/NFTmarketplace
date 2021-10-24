@extends('layouts/app')

@section('title', 'Home')


@section('content')

    <x-header firstname="{{ $user->firstname }}" />

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

    <h2 class="form-group__title">Filter:</h2>
    <form action="{{ url('/homepageFilter') }}" type="get">
        <select name="filter" id="filter"> 
            <option value="Price">Price</option>
            <option value="Area">Area</option>
            <option value="Type">Type</option>
        </select>
        <button type="submit">Submit </button>
    </form>

    @foreach ($nfts as $nft)
        <div>
            <a href="/nfts/{{ $nft->id }}">{{ $nft->title }}</a>

            {{-- add image --}}
        </div>
    @endforeach


    <p>1 euro = {{ $eth }}ETH</p>
    <section>
        <h1>Collections</h1>

        <div class="cardgallery">
            @foreach ($collections as $collection)
            <a class="card card--3col" href="/collections/{{ $collection->id }}">
                <img class="card__image" src="{{ $collection->image_file_path}}" alt="collection image">
                <img class="card__profilepicture--small" src="{{ $collection->image_file_path }}" alt="creator image">
                <div class="card__specs">
                    <div class="btn--favourite"></div>
                    <div class="btn--nftcount"><span>5</span></div>
                </div>
                <p class="card__title ta_c" style="margin-bottom: 12px;">{{ $collection->title }}</p>
                <p class="card__description body--normal"> {{ $collection->description }}</p>
            </a>
            @endforeach
        </div>
    </section>

    <section class="bg--2">
        <h1>NFT's</h1>

        <div class="cardgallery">
            @foreach ($nfts as $nft)
                <div class="card card--3col flex--spbet">
                    <img src="{{ $nft->image_file_path }}" alt="nft image" class="card__image card__image--large">
                    <p class="card__title ta_c" style="margin-bottom: 12px;">{{ $nft->title }}</p>
                    <div class="flex--spbet">
                        <a href="/nfts/{{ $nft->id }}" class="btn btn--light btn--1col">View</a>
                        <a href="/nfts/{{ $nft->id }}" class="btn btn--blue btn--155">Buy</a>
                    </div>
                </div>

            
            
            @endforeach
        </div>
    </section>



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