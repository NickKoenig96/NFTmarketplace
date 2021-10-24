<h1>searchResults</h1>

<p>1 euro = {{ $eth }}ETH</p>


@if ($data->isEmpty())
    <p>No results found</p>
@else
    @foreach ($data as $d)

        <p>{{ $d->title }}</p>
    @endforeach

@endif
