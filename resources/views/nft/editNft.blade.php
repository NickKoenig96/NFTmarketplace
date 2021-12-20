@extends('layouts/app')

@section('title', 'editNft')

@section('content')

        <x-header firstname="{{ $user->firstname }}" />

        <h1 class="card__title--headerThird">Edit NFT</h1>

        @if ($flash = session('message'))
            @component('components/alert')
                @slot('type') danger @endslot
                <p> {{ $flash }}</p>
            @endcomponent

        @endif


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
            <form id="editNftForm" method="POST" action="{{ url('/nft/editNft') }}" enctype='multipart/form-data'>
                @csrf
                <h2 class="form-group__title">Edit a new masterpiece</h2>
                <input type="hidden" name="id" value="{{ $nft->id }}">
                <label class="form-group__label" for="cTitle">Nft title</label><br>
                <input class="form-group__input" type="text" id="cTitle" value="{{ $nft->title }}" name="nftTitle"><br>

                <label class="form-group__label" for="nArea">Area (km²)</label><br>
                <input class="form-group__input" type="text" value="{{ $nft->area }}" id="nArea" name="nftArea"><br>

                <label class="form-group__label" for="nObjectType">Object type (moon-star-planet)</label><br>
                <input class="form-group__input" type="text" value="{{ $nft->object_type }}" id="nObjectType" name="nftObjectType"><br>

                <label class="form-group__label" for="cDescription">nft description</label><br>
                <textarea class="form-group__input" type="text" id="cDescription" name="nftDescription">{{ $nft->description }}</textarea><br>

                <label class="form-group__label" for="cDescription">Nft description</label><br>
                <input class="form-group__input" type="text" id="cDescription" value="{{ $nft->description }}" name="nftDescription"><br>

                <label class="form-group__label" for="collections">Choose collection</label><br>
                <select id="collections" name="collectionsId">
                    @foreach ($collections as $collection)
                        <option class="form-group__input" value="{{ $collection->id }}">
                            {{ $collection->title }}
                        </option>
                    @endforeach
                </select>
                <br>
                <input type="submit" name="upload" value="Edit">
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
