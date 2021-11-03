@extends('layouts/app')
@section('title', 'Profile')

@section('content')
    <x-header firstname="{{ $user->firstname }}" />

    <section>
        <p>1 euro = {{ $eth }}ETH</p>

        @if ($flash = session('message'))
            {{ $flash }}
        @endif

        <div class="flex flex--start flex--gap40">
            <div class="card pad-5perc">
                <img class="card__image--35vw" src="{{ $nft->image_file_path }}" alt="nft image"
                    class="card__image card__image--large">
            </div>
            <div class="nft__details flex--col flex--spbet">
                <div>
                    <h1>{{ $nft->title }}</h1>
                    <h4 class="blue--20">Owner: {{ $nft->owner->firstname . ' ' . $nft->owner->lastname }}</h4>
                    <div class="margint-12 flex flex--alcen">
                        <div class="btn--view"></div>
                        <h5 class="blue--20 marginr-48 marginl-12">11k Views</h5>
                        <a href="#" class="btn--favourite btn--favourite--small"></a>
                        <h5 class="blue--20 marginl-12">favourite</h5>
                    </div>
                    <h1 class="margint-48">&euro; {{ $nft->price }} <span class="marginl-24 body--normal">ETH
                            {{ $nft->price * $eth }}</span></h1>

                    <h3>Description</h3>
                    <p>{{ $nft->description }}</p>
                </div>
                @if ($nft->forSale === 1 && $user->id != $nft->owner_id)
                    <a href="/nft/buy/{{ $nft->id }}" class="btn btn--40 btn--blue btn--50perc">Buy this NFT</a>
                @endif
            </div>
        </div>
    </section>
    <section class="bg--2">
        <h1>Comments</h1>
        <div class="comment marginb-24 flex flex--start flex--gap40">
            <div class="form__control--80perc">
                <input type="text" placeholder="Your comment">
            </div>
            <div class="form__control--smaller">
                <input type="submit" value="Post">
            </div>
        </div>
        <ul>
            @foreach ($nft->comment as $c)
                <li class="comment">
                    <p class="comment__user">{{ '@' . 'Peter Celi' }}</p>
                    <p class="comment__text">{{ $c->text }}</p>
                    <div class="comment__details flex flex--start flex--gap40">
                        <p>Delete</p>
                        <p>5min ago</p>
                    </div>
                </li>
            @endforeach
        </ul>
    </section>
@endsection
