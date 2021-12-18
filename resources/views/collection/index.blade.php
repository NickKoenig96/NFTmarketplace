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
