@extends('layouts/app')
@extends('components/header')
{{-- @extends('views/sass/app') --}}

@section('title', 'AddNft')

@section('content')

    <h1>Add NFT</h1>

    <div class="form-group">
        <form method="POST" action="/nft/addNft" id="editNftForm">
            @csrf
            <h2 class="form-group__title">Upload a new masterpiece</h2>
            <input type="hidden" name='creator' value="{{ $user }}">

            <label class="form-group__label" for="nTitle"> title</label><br>
            <input class="form-group__input" type="text" id="nTitle" name="nftTitle"><br>

            <label class="form-group__label" for="nDescription">description</label><br>
            <input class="form-group__input" type="text" id="nDescription" name="nftDescription"><br>


            <label class="form-group__label" for="nImage">upload image</label><br>
            <input class="form-group__input--image" type="file" id="nImage" name="nftImage"><br>

            <label class="form-group__label" for="collections">choose collection</label><br>
            <select id="collections" name="collectionsId" form="editNftForm">
                @foreach ($collections as $collection)
                    <option class="form-group__input" value="{{ $collection->id }}">{{ $collection->title }}e</option>
                @endforeach
            </select>
            <br>

            <input class="btn-center" type="submit" name="upload" value="Add">

        </form>
    </div>

@endsection
