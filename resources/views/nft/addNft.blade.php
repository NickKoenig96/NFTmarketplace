@extends('layouts/app')

{{-- @extends('views/sass/app') --}}

@section('title', 'AddNft')

@section('content')

    <x-header firstname="{{ $user->firstname }}" />

    <h1 class="card__title--headerThird">Add NFT</h1>


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

            <label class="form-group__label" for="nTitle"> Title</label><br>
            <input class="form-group__input" type="text" value="{{ old('nftTitle') }}" id="nTitle" name="nftTitle"><br>

            <label class="form-group__label" for="nDescription">Description</label><br>
            <textarea class="form-group__input" type="text" id="nDescription"
                name="nftDescription">{{ old('nftDescription') }}</textarea><br>

            <label class="form-group__label" for="nArea">Area (km²)</label><br>
            <input class="form-group__input" type="text" value="{{ old('nftArea') }}" id="nArea" name="nftArea"><br>

            <label class="form-group__label" for="nObjectType">Object type (moon-star-planet)</label><br>
            <input class="form-group__input" type="text" value="{{ old('nftObjectType') }}" id="nObjectType"
                name="nftObjectType"><br>

            <label class="form-group__label" for="nPrice">Price (Euro)</label><br>
            <input class="form-group__input" type="text" value="{{ old('nftPrice') }}" id="nPrice" name="nftPrice"><br>

            <label class="form-group__label" for="nImage">Upload image</label><br>
            <input class="form-group__input--image" type="file" id="nImage" name="nftImage"><br>

            <label class="form-group__label" for="collections">Choose collection</label><br>
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
    </script>
@endsection
