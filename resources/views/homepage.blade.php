@extends('layouts/app')

@section('title', 'Home')

@section('content')
    <x-header firstname="{{ 'Jonathan' }}" />

    <section>
        <h1>Collections</h1>

        <div class="cardgallery">
            @foreach ($collections as $collection)
            <a class="card card--3col" href="/collections/{{ $collection->id }}">
                <img class="card__image" src="{{ $collection->image_file_path}}" alt="nft image">
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

    <section>
        <h1>NFT's</h1>

        <div class="cardgallery">
            @foreach ($nfts as $nft)
                <a href="/nfts/{{ $nft->id }}" class="card card--3col"></a>
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
