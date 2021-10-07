<h1>Collection</h1>
@foreach ($collections as $collection)
    <div>
        <p>{{ $collection->title }}</p>
    </div>

@endforeach
