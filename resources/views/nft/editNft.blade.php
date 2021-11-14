<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    @if ($errors->any())
        @component('components/alert')
            @slot('type') danger @endslot
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endcomponent
    @endif



    <form method="POST" action="{{ url('/nft/editNft') }}" enctype='multipart/form-data'>>
        @csrf

        <input type="hidden" name="id" value="{{ $nft->id }}">

        <label for="cTitle">nft title</label><br>
        <input type="text" id="cTitle" value="{{ $nft->title }}" name="nftTitle"><br>


        <label for="cDescription">nft description</label><br>
        <input type="text" id="cDescription" value="{{ $nft->description }}" name="nftDescription"><br>

        <label class="form-group__label" for="nArea">Area</label><br>
        <input class="form-group__input" type="text" value="{{ $nft->area }}" id="nArea" name="nftArea"><br>

        <label class="form-group__label" for="nObjectType">Object type</label><br>
        <input class="form-group__input" type="text" value="{{ $nft->object_type }}" id="nObjectType"
            name="nftObjectType"><br>


        <label class="form-group__label" for="nPrice">Price (Euro)</label><br>
        <input class="form-group__input" type="text" value="{{ $nft->price }}" id="nPrice" name="nftPrice"><br>

        <label for="nImage">nft image</label><br>
        <input type="file" value="{{ $nft->image_file_path }}" name="nftImage"> <br>

        <label class="form-group__label" for="collections">choose collection</label><br>
        <select id="collections" name="collectionsId">
            @foreach ($collections as $collection)
                <option class="form-group__input" value="{{ $collection->id }}">{{ $collection->title }}</option>
            @endforeach
        </select>
        <br>


        <input type="submit" name="upload" value="edit">

    </form>
</body>

</html>
