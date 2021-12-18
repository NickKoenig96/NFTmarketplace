@extends('layouts/app')

@section('title', 'editNft')

@section('content')

    <body>


        <x-header firstname="{{ $user->firstname }}" />


        @if ($flash = session('message'))
            @component('components/alert')
                @slot('type') danger @endslot
                <p> {{ $flash }}</p>
            @endcomponent

        @endif



        <h1>Edit NFT</h1>

        @if ($errors->any())
            @component('components/alert')
                @slot('type') danger @endslot
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endcomponent
        @endif

        <div class="form-group">
            <form method="POST" action="{{ url('/nft/editNft') }}" enctype='multipart/form-data'>
                @csrf

                <h1>Edit NFT</h1>

                <div class="form-group">
                    <form method="POST" action="{{ url('/nft/editNft') }}" enctype='multipart/form-data'>
                        @csrf

                        <h2 class="form-group__title">Edit a new masterpiece</h2>
                        <input type="hidden" name="id" value="{{ $nft->id }}">


                        <label class="form-group__label" for="cTitle">nft title</label><br>
                        <input class="form-group__input" type="text" id="cTitle" value="{{ $nft->title }}"
                            name="nftTitle"><br>

                        <label class="form-group__label" for="nArea">Area (km²)</label><br>
                        <input class="form-group__input" type="text" value="{{ $nft->area }}" id="nArea"
                            name="nftArea"><br>

                        <label class="form-group__label" for="nObjectType">Object type (moon-star-planet)</label><br>
                        <input class="form-group__input" type="text" value="{{ $nft->object_type }}" id="nObjectType"
                            name="nftObjectType"><br>

                        <label class="form-group__label" for="nPrice">Price (Euro)</label><br>
                        <input class="form-group__input" type="text" value="{{ $nft->price }}" id="nPrice"
                            name="nftPrice"><br>





                        <label class="form-group__label" for="cDescription">nft description</label><br>
                        <input class="form-group__input" type="text" id="cDescription" value="{{ $nft->description }}"
                            name="nftDescription"><br>

                        <label class="form-group__label" for="collections">choose collection</label><br>
                        <select id="collections" name="collectionsId">
                            @foreach ($collections as $collection)
                                <option class="form-group__input" value="{{ $collection->id }}">
                                    {{ $collection->title }}
                                </option>
                            @endforeach
                        </select>




                        <input type="submit" name="upload" value="edit">

                    </form>
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
