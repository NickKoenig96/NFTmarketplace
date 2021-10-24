@extends('layouts/app')
@section('title', 'Home')

@section('content')
    @foreach ($nfts as $nft)  
        @if($filter == 'Price')
            <p>{{ $nft->price }}</p>
            <p>{{ $nft->title }}</p>
        @elseif($filter == 'Area')
            <p>{{ $nft->area }}</p>
            <p>{{ $nft->title }}</p>
        @else
            <p>{{ $nft->object_type }}</p>
            <p>{{ $nft->title }}</p> 
        @endif
    @endforeach
@endsection 