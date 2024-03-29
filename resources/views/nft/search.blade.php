@extends('layouts/app')

@section('title', 'Home')



@section('content')


    <x-header firstname="{{ $user->firstname }}" />

    <section>

        <h1 class="card__title--headerSecond">Search results</h1>

        <p class="info--eth">1 euro = {{ $eth }}ETH</p>
        @if ($category === 'Collections')

            @if ($collections->isEmpty())
                <p>Sorry no results found</p>
            @else
                <div class="cardgallery">
                    @foreach ($collections as $collection)
                        <a class="card card--3col" href="/collections/{{ $collection->id }}">
                            <img class="card__image" src="{{ $collection->image_file_path }}" alt="collection image">
                            <img class="card__profilepicture--small" src="{{ $collection->image_file_path }}"
                                alt="creator image">
                            <div class="card__specs">
                                <!-- <div class="btn--favourite"></div> -->
                                <div class="btn--nftcount"><span>5</span></div>
                            </div>
                            <p class="card__title ta_c" style="margin-bottom: 12px;">{{ $collection->title }}</p>
                            <p class="card__description body--normal"> {{ $collection->description }}</p>
                        </a>
                    @endforeach
                </div>
            @endif
        @endif



        @if ($category === 'NFTs')
            @if ($nfts->isEmpty())
                <p>Sorry no results found</p>

            @else
                <div class="cardgallery">
                    @foreach ($nfts as $nft)
                        <div class="card card--3col flex--spbet">
                            <img src="{{ $nft->image_file_path }}" alt="nft image" class="card__image card__image--large">
                            <div class="marginb-24">
                                <div class="flex--spbet">
                                    <p class="card__title" style="margin-bottom: 0px;">{{ $nft->title }}</p>
                                    @livewire("favorites", ['nftId' => $nft->id, 'userId' => $user->id])
                                </div>
                                <span class="card__price">€ {{ $nft->price }}</span>
                                <br>
                                <span class="card__price">ETH {{ $eth * $nft->price }}</span>

                            </div>
                            <div class="flex--spbet">
                                <a href="/nfts/{{ $nft->id }}" class="btn btn--light btn--1col">View</a>
                                <a href="/nfts/{{ $nft->id }}" class="btn btn--blue btn--155">Buy</a>
                            </div>
                        </div>
                    @endforeach
                </div>


            @endif

        @endif
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
