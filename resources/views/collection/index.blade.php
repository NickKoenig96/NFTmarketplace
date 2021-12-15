@extends('layouts/app')
@section('title', 'Collections')

@section('content')
<x-header firstname="{{ $user->firstname }}" />

<section>
        
        <h1>Collections</h1>


        <div class="cardgallery">
            @foreach ($collections as $collection)
                <a class="card card--3col" href="/collections/{{ $collection->id }}">
                    <img class="card__image" src="{{ $collection->image_file_path }}" alt="collection image">
                    <img class="card__profilepicture--small" src="{{ $collection->creator->avatar }}" alt="creator image">
                    <div class="card__specs">
                        <!-- <div class="btn--favourite"></div> -->
                        <div class="btn--nftcount"><span> {{ $collection->nft()->count() }}</span></div>
                    </div>
                    <p class="card__title ta_c" style="margin-bottom: 12px;">{{ $collection->title }}</p>
                    <p class="card__description body--normal"> {{ $collection->description }}</p>
                </a>
            @endforeach
        </div>
    </section>

@endsection
