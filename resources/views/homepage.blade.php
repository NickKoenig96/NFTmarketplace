@extends('layouts/app')
@section('title', 'Home')

@section('content')
    <x-header firstname="{{ 'Jonathan' }}" />
    <h1>Homepage</h1>

    @foreach ($nfts as $nft)
        <div>
            <a href="/nfts/{{$nft->id}}">{{ $nft->title }}</a>
            {{-- add image --}}
        </div>
    @endforeach

@endsection