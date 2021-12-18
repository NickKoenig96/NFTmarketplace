@extends('layouts/app')

@section('title', 'Home')

@section('content')
    <x-header firstname="{{ $user->firstname }}" />
    <div class="cardgallery">
        @foreach ($nfts as $nft)
            <div class="card card--3col flex--spbet">
                @if ($filter == 'Price')
                    <img src="{{ $nft->image_file_path }}" alt="nft image" class="card__image card__image--large">
                    <p class="card__title ta_c" style="margin-bottom: 12px;">{{ $nft->title }}</p>
                    <p class="card__title ta_c" style="margin-bottom: 12px;">€ {{ $nft->price }} </p>
                    <div class="flex--spbet">
                        <a href="/nfts/{{ $nft->id }}" class="btn btn--light btn--1col">View</a>
                        @if ($nft->forSale === 1 && $user->id != $nft->owner_id)
                            <a href="/nft/buy/{{ $nft->id }}" class="btn btn--blue btn--155">Buy</a>
                        @endif
                    </div>
                @elseif($filter == 'Area')
                    <img src="{{ $nft->image_file_path }}" alt="nft image" class="card__image card__image--large">
                    <p class="card__title ta_c" style="margin-bottom: 12px;">{{ $nft->title }}</p>
                    <p class="card__title ta_c" style="margin-bottom: 12px;">{{ $nft->area }} km2</p>
                    <div class="flex--spbet">
                        <a href="/nfts/{{ $nft->id }}" class="btn btn--light btn--1col">View</a>
                        @if ($nft->forSale === 1 && $user->id != $nft->owner_id)
                            <a href="/nft/buy/{{ $nft->id }}" class="btn btn--blue btn--155">Buy</a>
                        @endif
                    </div>
                @else
                    <img src="{{ $nft->image_file_path }}" alt="nft image" class="card__image card__image--large">
                    <p class="card__title ta_c" style="margin-bottom: 12px;">{{ $nft->title }}</p>
                    <p class="card__title ta_c" style="margin-bottom: 12px;">Type: {{ $nft->object_type }} </p>
                    <div class="flex--spbet">
                        <a href="/nfts/{{ $nft->id }}" class="btn btn--light btn--1col">View</a>
                        @if ($nft->forSale === 1 && $user->id != $nft->owner_id)
                            <a href="/nft/buy/{{ $nft->id }}" class="btn btn--blue btn--155">Buy</a>
                        @endif
                    </div>
                @endif
            </div>
        @endforeach
    </div>

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
