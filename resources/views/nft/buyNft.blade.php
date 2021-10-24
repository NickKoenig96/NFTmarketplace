@extends('layouts/app')
@section('title', 'Buy ')

@section('content')

<p>{{ $nft->title }}</p>
<p>{{ $nft->description }}</p>

@if($nft->forSale === 1)
<form method="POST" action="{{ url('/nft/order') }}" enctype='multipart/form-data'>
@csrf
<input type="hidden" name="id" value="{{ $nft->id }}">
<input type="hidden" name="price" value="{{ $nft->price }}">
<input type="hidden" name="seller" value="{{ $nft->owner_id }}">
<input type="hidden" name="buyer" value="{{ $user }}">

<input type="submit" value="Buy">

</form>
@endif

@endsection