@extends('layouts/app')

@section('title', 'Home')


@section('content')

    <p>{{ $nft->title }}</p>

    <form method="POST" action="{{ url('/nft/markForSale') }}" enctype='multipart/form-data'>
        @csrf
            <input type="hidden" name="id" value="{{ $nft->id }}">
            <label for="price">Price</label>
            <input type="number" name="price" id="price" value="price">
            <input type="submit" value="mark for sale">
    </form>



@endsection