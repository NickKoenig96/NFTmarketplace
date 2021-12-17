@extends('layouts/app')

@section('title', 'editCollection')

@section('content')


<body>

    

    

<x-header firstname="{{ $user->firstname }}" />

<h1>Edit Collection</h1>
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
        <form method="POST" action="{{ '/collection/editCollection' }}" enctype='multipart/form-data'>
            @csrf

            <h2 class="form-group__title">Edit a new masterpiece</h2>
            <input type="hidden" name="id" value="{{ $collection->id }}">

            <label class="form-group__label" for="cTitle">Collection title</label><br>
            <input class="form-group__input" type="text" id="cTitle" value="{{ $collection->title }}" name="collectionTitle"><br>

            <label class="form-group__label" for="cDescription">Collection description</label><br>
            <input class="form-group__input" type="text" id="cDescription" value="{{ $collection->description }}" name="collectionDescription"><br>

            <label class="form-group__label" for="cImage">collection image</label><br>
            <input class="form-group__input--image" type="file" name="collectionImage"> <br>

            <input type="submit" name="upload">

        </form>
    </div>

@endsection