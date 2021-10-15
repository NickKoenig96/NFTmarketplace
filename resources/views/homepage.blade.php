<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>

    <title>Document</title>
</head>

<body>
    <h1>Homepage</h1>

    <form action="{{ url('/search') }}" type="get">
        <select name="category" id="category">
            <option value="Collections">Collections</option>
            <option value="NFT's">NFT's</option>
        </select>
        <input class="form-control-lg" type="search" id="search" name="searchTerm" placeholder="Search"
            aria-label="Search">
        <button type="submit">Search </button>
    </form>

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

</body>

</html>
