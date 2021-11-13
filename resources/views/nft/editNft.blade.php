@extends('layouts/app')

@section('title', 'editNft')

@section('content')

<x-header firstname="{{ $user->firstname }}" />

<h1>Edit NFT</h1>

    <div class="form-group">
        <form method="POST" action="{{ url('/nft/editNft') }}" enctype='multipart/form-data'>
            @csrf

            <h2 class="form-group__title">Edit a new masterpiece</h2>
            <input type="hidden" name="id" value="{{ $nft->id }}">

            <label class="form-group__label" for="cTitle">nft title</label><br>
            <input class="form-group__input" type="text" id="cTitle" value="{{ $nft->title }}" name="nftTitle"><br>


            <label class="form-group__label" for="cDescription">nft description</label><br>
            <input class="form-group__input" type="text" id="cDescription" value="{{ $nft->description }}" name="nftDescription"><br>

            <label class="form-group__label" for="nImage">nft image</label><br>
            <input class="form-group__input--image" type="file" name="nftImage"> <br>


            <input type="submit" name="upload" value="edit">

        </form>
    </div>

@endsection