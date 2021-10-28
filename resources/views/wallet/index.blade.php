@extends('layouts/app')

@section('title', 'Home')


@section('content')

    <x-header firstname="{{ $user->firstname }}" />

    <section>

        <h1>wallet</h1>


        <br>
        <section>
            <h3>My NFT's</h3>
            <a href="/nft/addNft" class="btn btn--blue btn--155">add NFT</a>
            <br>
            <div class="cardgallery">
                @foreach ($nfts as $nft)
                    @if ($nft->owner_id == $user->id)

                        <div class="card card--3col flex--spbet">
                            <img src="{{ $nft->image_file_path }}" alt="nft image" class="card__image card__image--large">
                            <div class="marginb-24">
                                <div class="flex--spbet">
                                    <p class="card__title" style="margin-bottom: 0px;">{{ $nft->title }}</p>
                                    <div class="btn--favourite"></div>
                                </div>
                                <span class="card__price">€ {{ $nft->price }}</span>
                                <br>
                                <span class="card__price">ETH {{ $eth * $nft->price }}</span>

                            </div>
                            <div class="flex--spbet">
                                <a href="/nfts/{{ $nft->id }}" class="btn btn--light btn--1col">View</a>
                                <a href="/nfts/{{ $nft->id }}" class="btn btn--blue btn--155">Buy</a>

                            </div>
                            <br>
                            <div class="flex--spbet">
                                <a href="delete/nft/{{ $nft->id }}" class="btn btn--red btn--155">DELETE</a>
                                <a href="edit/nft/{{ $nft->id }}" class="btn btn--green btn--155">EDIT</a>

                            </div>
                        </div>
                    @endif

                @endforeach
            </div>
        </section>

        <section class="bg--2">
            <h3>My Collections</h3>
            <a href="/collection/addCollection" class="btn btn--blue btn--155">add Collection</a>
            <br>
            <div class="cardgallery">
                @foreach ($collections as $collection)
                    @if ($collection->creator_id == $user->id)
                        <div>
                            <div class="card card--3col" href="/collections/{{ $collection->id }}">
                                <img class="card__image" src="{{ $collection->image_file_path }}"
                                    alt="collection image">
                                <img class="card__profilepicture--small" src="{{ $collection->image_file_path }}"
                                    alt="creator image">
                                <div class="card__specs">
                                    <!-- <div class="btn--favourite"></div> -->
                                    <div class="btn--nftcount"><span>5</span></div>
                                </div>
                                <div>
                                    <p class="card__title ta_c" style="margin-bottom: 12px;">{{ $collection->title }}</p>
                                    <p class="card__description body--normal"> {{ $collection->description }}</p>
                                </div>
                                <br>
                                <div class="flex--spbet">
                                    <a href="delete/nft/{{ $nft->id }}" class="btn btn--red btn--155">DELETE</a>
                                    <a href="edit/nft/{{ $nft->id }}" class="btn btn--green btn--155">EDIT</a>

                                </div>
                            </div>


                        </div>


                    @endif
                @endforeach
            </div>
        </section>



    </section>

@endsection
