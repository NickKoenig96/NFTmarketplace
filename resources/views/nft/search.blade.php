<h1>searchResults</h1>


@if ($data->isEmpty())
    <p>No results found</p>
@else
    @foreach ($data as $d)

        <p>{{ $d->title }}</p>
    @endforeach

@endif
