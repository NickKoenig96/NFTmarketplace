@extends('layouts/app')
@extends('components/header')

@section('title', 'AddNft')

@section('content')

    <h1>Add collection</h1>

    <div class="form-group">
        <form method="POST" action="/collection/addCollection" enctype='multipart/form-data'>
            @csrf
            <h2 class="form-group__title">New collection for your NFT's</h2>
            <label class="form-group__label" for="cTitle">title</label><br>
            <input class="form-group__input" type="text" id="cTitle" name="collectionTitle"><br>

            <label class="form-group__label" for="cDescription">description</label><br>
            <input class="form-group__input" type="text" id="cDescription" name="collectionDescription"><br>

            <label class="form-group__label" for="cImage">upload image</label><br>
            <input class="form-group__input--image" type="file" name="collectionImage"> <br>
            <input class="btn-center" type="submit" name="upload" value="Add">
        </form>
    </div>

@endsection