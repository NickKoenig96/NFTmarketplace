@extends('layouts/app')

@section('title', 'Home')

@section('content')
<x-header firstname="{{ $user->firstname }}" />
    <div class="cardgallery">
        @foreach ($nfts as $nft)
            <div class="card card--3col flex--spbet">  
                @if($filter == 'Price')
                    <img src="{{ $nft->image_file_path }}" alt="nft image" class="card__image card__image--large">
                    <p class="card__title ta_c" style="margin-bottom: 12px;">{{ $nft->title }}</p>
                    <p class="card__title ta_c" style="margin-bottom: 12px;">€ {{ $nft->price }} </p>
                    <div class="flex--spbet">
                        <a href="/nfts/{{ $nft->id }}" class="btn btn--light btn--1col">View</a>
                        <a href="/nfts/{{ $nft->id }}" class="btn btn--blue btn--155">Buy</a>
                    </div>
                @elseif($filter == 'Area')
                    <img src="{{ $nft->image_file_path }}" alt="nft image" class="card__image card__image--large">
                    <p class="card__title ta_c" style="margin-bottom: 12px;">{{ $nft->title }}</p>
                    <p class="card__title ta_c" style="margin-bottom: 12px;">{{ $nft->area }} km2</p>
                    <div class="flex--spbet">
                        <a href="/nfts/{{ $nft->id }}" class="btn btn--light btn--1col">View</a>
                        <a href="/nfts/{{ $nft->id }}" class="btn btn--blue btn--155">Buy</a>
                    </div>
                @else
                    <img src="{{ $nft->image_file_path }}" alt="nft image" class="card__image card__image--large">
                    <p class="card__title ta_c" style="margin-bottom: 12px;">{{ $nft->title }}</p>
                    <p class="card__title ta_c" style="margin-bottom: 12px;">Type: {{ $nft->object_type }} </p>
                    <div class="flex--spbet">
                        <a href="/nfts/{{ $nft->id }}" class="btn btn--light btn--1col">View</a>
                        <a href="/nfts/{{ $nft->id }}" class="btn btn--blue btn--155">Buy</a>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
@endsection 