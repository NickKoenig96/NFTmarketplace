@extends('layouts/app')


@section('title', 'AddNft')

@section('content')

    <x-header firstname="{{ $user->firstname }}" />


    <h1>Add collection</h1>

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
        <form method="POST" action="/collection/addCollection" enctype='multipart/form-data'>
            @csrf
            <h2 class="form-group__title">New collection for your NFT's</h2>
            <label class="form-group__label" for="cTitle">title</label><br>
            <input class="form-group__input" value="{{ old('collectionTitle') }}" type="text" id="cTitle" name="collectionTitle"><br>

            <label class="form-group__label" for="cDescription">description</label><br>
            <textarea class="form-group__input" type="text" id="cDescription" name="collectionDescription">{{ old('collectionDescription') }}</textarea><br>

            <label class="form-group__label" for="cImage">upload image</label><br>
            <input class="form-group__input--image" type="file" name="collectionImage"> <br>
            <input class="btn-center" type="submit" name="upload" value="Add">
        </form>
    </div>

@endsection
