@extends('layouts/app')

@section('title', 'Home')



@section('content')

    <x-header firstname="{{ $user->firstname }}" />

    {{-- <h1>Homepage</h1> --}}

    <section>
        <p>1 euro = {{ $eth }}ETH</p>
        <h1>NFT's</h1>

        <div class="cardgallery">
            @foreach ($nfts as $nft)
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
                        @if ($nft->forSale === 1 && $user->id != $nft->owner_id)
                            <a href="/nft/buy/{{ $nft->id }}" class="btn btn--blue btn--155">Buy</a>
                        @endif
                    </div>
                    <div class="flex--spbet">
                        @if ($nft->owner_id == $user->id)
                            <a href="" class="btn btn--blue btn--155 btn--mint">Mint NFT</a>

                            @if ($nft->forSale === 0)
                                <a href="/nft/sell/{{ $nft->id }}" class="btn btn--blue btn--155">Sell NFT</a>
                            @elseif($nft->forSale === 1)
                                <p class="info">Your NFT is for sale</p>
                            @endif

                        @elseif($nft->creator != $user && $nft->minted == 0 && $nft->forsale == 0)

                            <p class="info">This NFT has not been minted yet</p>

                            @if ($nft->forSale === 0)
                                <p class="info">This NFT is not for sale right now</p>
                            @endif

                        @endif
                    </div>
                </div>
            @endforeach
        </div>

    @endsection
