@extends('layouts/app')
@section('title', 'NFT')

@section('content')
    <x-header firstname="{{ $user->firstname }}" />

    <section>
        <p>1 euro = {{ $eth }}ETH</p>

        @if ($flash = session('message'))
            @component('components/alert')
                @slot('type') succes @endslot
                <p> {{ $flash }}</p>
            @endcomponent

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
                <!-- juist ifloop voor de sales -->
                @if($nft->creator_id === $user->id)
                            @if($nft->minted === 0)
                                <button data-owner="{{$nft->owner_id}}" data-price="{{$eth * $nft->price}}" data-id="{{$nft->id}}" data-hash="{{$nft->item_hash}}" data-image="{{$nft->image_file_path}}" class="btn--mint">Mint NFT</button>
                            @endif
                        @endif
                        @if($nft->owner_id === $user->id && $nft->minted === 1)
                            @if($nft->forSale === 0)
                                <a href="" id="sellBtn" data-id="{{ $nft->id }}" data-price="{{$eth * $nft->price }}" data-token="{{ $nft->token_id }}" class="btn btn--blue btn--155">Sell NFT</a>
                            @elseif($nft->forSale === 1)
                                <p style="display:block" class="info">Your NFT is for sale</p>
                            @endif
                        @endif

                        @if($nft->owner_id != $user->id && $nft->forSale === 1 && $nft->minted === 1)
                            <a href="/nft/buy/{{ $nft->id }}" class="btn btn--blue btn--155">Buy</a>
                        @endif
            </div>
        </div>
    </section>
    <section class="bg--2">
        <h1>Comments</h1>
        <!-- <form method="post" action="{{ url('/comment/store') }}">
                    @csrf
                    <div class="comment marginb-24 flex flex--start flex--gap40">
                        <div class="form__control--80perc">
                            <input type="text" id="comment" name="comment" placeholder="Your comment">
                        </div>
                        <input type="hidden" id="nft_id" name="nft_id" value="{{ $nft->id }}">
                        <input type="hidden" id="user_id" name="user_id" value="{{ $user->id }}">
                        <div class="form__control--smaller">
                            <input  type="submit" value="Post">
                        </div>
                    </div>
                </form> -->


        @livewire("new-comment", ['nftId' => $nft->id, 'userId' => $user->id, 'userFirstname' => $user->firstname,
        'userLastname' => $user->lastname])
        @livewire("all-comments", ['nftId' => $nft->id, 'userId' => $user->id, 'userFirstname' => $user->firstname,
        'userLastname' => $user->lastname])


        <!-- <ul>
                    @foreach ($comments as $comment)
                        <li class="comment">
                            <p class="comment__user">{{ $comment->user->firstname . ' ' . $comment->user->lastname }}</p>
                            <p class="comment__text">{{ $comment->text }}</p>
                            <div class="comment__details flex flex--start flex--gap40">
                                <p>Delete</p>
                            </div>
                        </li>
                    @endforeach
                </ul> -->
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

        let option = document.getElementById("option");
        option.style.display = "none";

        function priceVisible() {
            option.innerHTML = `<option value="">Select</option>`;
            option.innerHTML += `<option id="PriceLH" value="PriceLH">Price LOW to HIGH</option>`;
            option.innerHTML += `<option id="HLPrice" value="PriceHL">Price HIGH to LOW</option>`;
        }

        function areaVisible() {
            option.innerHTML = `<option value="">Select</option>`;
            option.innerHTML += `<option id="AreaLH" value="AreaLH">Area LOW to HIGH</option>`;
            option.innerHTML += `<option id="HLArea" value="AreaHL">Area HIGH to LOW</option>`;
        }

        function typeVisible() {
            option.innerHTML = `<option value="">Select</option>`;
            option.innerHTML += `<option id="TypeAZ" value="TypeAZ">Object type title (A-Z)</option>`;
            option.innerHTML += `<option id="ZAType" value="TypeZA">Object type title (Z-A)</option>`;
        }


        let filter = document.getElementById("filter");

        filter.addEventListener("change", function(e) {
            let selectedIndex = filter.selectedIndex;
            let selectedValue = filter[selectedIndex].value;
            console.log(selectedValue);

            if (selectedValue == 'Price') {
                option.style.display = "inline-block";
                priceVisible();
            } else if (selectedValue == "Area") {
                option.style.display = "inline-block";
                areaVisible();
            } else if (selectedValue == "Type") {
                option.style.display = "inline-block";
                typeVisible();
            } else {
                option.style.display = "none";
            }
        });
    </script>
@endsection
