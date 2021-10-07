<h1>wallet</h1>

<h2>Your collections (at the moment all collections)</h2>

@foreach ($collections as $collection)
    <div>
        <p>id = {{ $collection->id }}</p>
        <p>{{ $collection->title }}</p>
        <a href="delete/{{ $collection->id }}">DELETE</a>
    </div>

@endforeach
