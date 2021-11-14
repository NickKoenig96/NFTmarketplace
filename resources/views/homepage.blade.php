@extends('layouts/app')

@section('title', 'Home')



@section('content')

    <x-header firstname="{{ $user->firstname }}" />

    {{-- <h1>Homepage</h1> --}}

    <section>
        <p>1 euro = {{ $eth }}ETH</p>
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
        <div class="btn__container">
            <a class="btn btn--blue" href="/collections">See all collections</a>
        </div>
    </section>

    <section class="bg--2">
        <h1>NFT's</h1>
        <form action="{{ url('/homepageFilter') }}" type="get">
            <h2 class="form-group__title">Filter:</h2>
            <select class="filter" name="filter" id="filter">
                <option value="">Select</option>
                <option id="price" value="Price">Price</option>
                <option id="area" value="Area">Area</option>
                <option id="type" value="Type">Type</option>
            </select>
            <select name="option" id="option">
                {{-- options in javascript --}}
            </select>
            <button type="submit" class="btn--blue btn--h40 btn--center">Submit </button>
        </form>

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

        function priceVisible(){
            option.innerHTML = `<option value="">Select</option>`;
            option.innerHTML += `<option id="PriceLH" value="PriceLH">Price LOW to HIGH</option>`;
            option.innerHTML += `<option id="HLPrice" value="PriceHL">Price HIGH to LOW</option>`;
        }

        function areaVisible(){
            option.innerHTML = `<option value="">Select</option>`;
            option.innerHTML += `<option id="AreaLH" value="AreaLH">Area LOW to HIGH</option>`;
            option.innerHTML += `<option id="HLArea" value="AreaHL">Area HIGH to LOW</option>`;
        }

        function typeVisible(){
            option.innerHTML = `<option value="">Select</option>`;
            option.innerHTML += `<option id="TypeAZ" value="TypeAZ">Object type title (A-Z)</option>`;
            option.innerHTML += `<option id="ZAType" value="TypeZA">Object type title (Z-A)</option>`;
        }
       

        let filter = document.getElementById("filter");

        filter.addEventListener("change", function(e) {
            let selectedIndex = filter.selectedIndex;
            let selectedValue = filter[selectedIndex].value;
            console.log(selectedValue);

            if(selectedValue == 'Price'){
                option.style.display = "inline-block";
                priceVisible();
            }else if(selectedValue == "Area"){
                option.style.display = "inline-block";
                areaVisible();
            }else if(selectedValue == "Type"){
                option.style.display = "inline-block";
                typeVisible();
            }else{
                option.style.display = "none";
            }
        });
    </script>



@endsection
