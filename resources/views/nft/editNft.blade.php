@extends('layouts/app')

@section('title', 'editNft')

@section('content')
<body>

    



    <form method="POST" action="{{ url('/nft/editNft') }}" enctype='multipart/form-data'>>
        @csrf

<x-header firstname="{{ $user->firstname }}" />

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

            <h2 class="form-group__title">Edit a new masterpiece</h2>
            <input type="hidden" name="id" value="{{ $nft->id }}">


            <label class="form-group__label" for="cTitle">nft title</label><br>
            <input class="form-group__input" type="text" id="cTitle" value="{{ $nft->title }}" name="nftTitle"><br>

        <label class="form-group__label" for="nArea">Area</label><br>
        <input class="form-group__input" type="text" value="{{ $nft->area }}" id="nArea" name="nftArea"><br>

        <label class="form-group__label" for="nObjectType">Object type</label><br>
        <input class="form-group__input" type="text" value="{{ $nft->object_type }}" id="nObjectType"
            name="nftObjectType"><br>


        <label class="form-group__label" for="nPrice">Price (Euro)</label><br>
        <input class="form-group__input" type="text" value="{{ $nft->price }}" id="nPrice" name="nftPrice"><br>

        <label class="form-group__label" for="collections">choose collection</label><br>
        <select id="collections" name="collectionsId">
            @foreach ($collections as $collection)
                <option class="form-group__input" value="{{ $collection->id }}">{{ $collection->title }}</option>
            @endforeach
        </select>
        <br>

            <label class="form-group__label" for="cDescription">nft description</label><br>
            <textarea class="form-group__input" type="text" id="cDescription" name="nftDescription">{{ $nft->description }}</textarea><br>


            <input type="submit" name="upload" value="edit">

        </form>
    </div>

@endsection