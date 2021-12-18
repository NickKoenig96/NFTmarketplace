@extends('layouts/app')

{{-- @extends('views/sass/app') --}}

@section('title', 'AddNft')

@section('content')

    <x-header firstname="{{ $user->firstname }}" />

    <h1>Add NFT</h1>


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
        <form method="POST" action="/nft/addNft" id="editNftForm" enctype='multipart/form-data'>
            @csrf
            <h2 class="form-group__title">Upload a new masterpiece</h2>
            <input type="hidden" name='creator' value="{{ $user->id }}">

            <label class="form-group__label" for="nTitle"> title</label><br>
            <input class="form-group__input" type="text" value="{{ old('nftTitle') }}" id="nTitle" name="nftTitle"><br>

            <label class="form-group__label" for="nDescription">description</label><br>
            <textarea class="form-group__input" type="text" id="nDescription"
                name="nftDescription">{{ old('nftDescription') }}</textarea><br>

            <label class="form-group__label" for="nArea">Area (km²)</label><br>
            <input class="form-group__input" type="text" value="{{ old('nftArea') }}" id="nArea" name="nftArea"><br>

            <label class="form-group__label" for="nObjectType">Object type (moon-star-planet)</label><br>
            <input class="form-group__input" type="text" value="{{ old('nftObjectType') }}" id="nObjectType"
                name="nftObjectType"><br>

            <label class="form-group__label" for="nPrice">Price (Euro)</label><br>
            <input class="form-group__input" type="text" value="{{ old('nftPrice') }}" id="nPrice" name="nftPrice"><br>

            <label class="form-group__label" for="nImage">upload image</label><br>
            <input class="form-group__input--image" type="file" id="nImage" name="nftImage"><br>

            <label class="form-group__label" for="collections">choose collection</label><br>
            <select id="collections" name="collectionsId" form="editNftForm">
                @foreach ($collections as $collection)
                    <option class="form-group__input" value="{{ $collection->id }}">{{ $collection->title }}</option>
                @endforeach
            </select>
            <br>

            <input class="btn-center" type="submit" name="upload" value="Add">

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
