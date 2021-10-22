<h1>Collection</h1>
@foreach ($collections as $collection)
    <div>
        <p>{{ $collection->title }}</p>
        <img src="{{ $collection->image_file_path }}" alt="">
    </div>

@endforeach
