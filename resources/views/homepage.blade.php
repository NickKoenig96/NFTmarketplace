@extends('layouts/app')

@section('title', 'Home')

@section('content')
    <x-header firstname="{{ 'Jonathan' }}" />

    <p>1 euro = {{ $eth }}ETH</p>

    <h1>Homepage</h1>

    @foreach ($nfts as $nft)
        <div>
            <a href="/nfts/{{ $nft->id }}">{{ $nft->title }}</a>

            {{-- add image --}}
        </div>
    @endforeach




    <script>
        var path = "{{ url('homepage/action') }}";



        $('#search').typeahead({


            source: function(query, process) {

                return $.get(path, {
                    term: query,
                    category: $("select#category").val()

                }, function(data) {
                    return process(data);

                });

            }

        });
    </script>



@endsection
