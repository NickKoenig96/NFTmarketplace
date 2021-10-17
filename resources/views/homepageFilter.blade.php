@extends('layouts/app')
@section('title', 'Home')

@section('content')
        {{-- @foreach($nfts ?? '' as $nft)
            <p>{{$nfts ?? ''->title}}<p>
        @endforeach --}}
    {{-- @foreach ($nf as $nft)
        <p>{{ $nft->title }}</p>
    @endforeach --}}
    @foreach ($data as $d)
        {{-- <p>{{ $d->title }}</p> --}}
        <p>{{ $d }}</p>
        {{-- <p>{{ $d->title }}</p> --}}
    @endforeach


@endsection 