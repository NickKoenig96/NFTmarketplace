@extends('layouts/app')
@section('title', 'Collections')

@section('content')
<x-header firstname="{{ $user->firstname }}" />

<section>

    <h1>{{ $collection->title }}</h1>

    <div class="flex flex--start flex--gap40">
            <div class="card pad-5perc">
                <img class="card__image--35vw" src="{{ $collection->image_file_path }}" alt="collection image" class="card__image card__image--large">
            </div>
            <div class="nft__details flex--col flex--spbet">
                <div>
                    <h1>{{ $collection->title }}</h1>
                    <h4 class="blue--20">Creator: {{ $collection->creator->firstname . " " . $collection->creator->lastname }}</h4>
                    <div class="margint-12 flex flex--alcen">
                        <div class="btn--view"></div><h5 class="blue--20 marginr-48 marginl-12">11k Views</h5>
                        <!-- <a href="#" class="btn--favourite btn--favourite--small"></a><h5 class="blue--20 marginl-12">favourite</h5> -->
                    </div>
                    
                    <h3>Description</h3>
                    <p>{{ $collection->description }}</p>
                </div>
            </div>
        </div>
    </section>


</section>
@endsection