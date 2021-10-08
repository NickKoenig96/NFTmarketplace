<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <form method="POST" action="/nft/editNft">
        @csrf

        <input type="hidden" name="id" value="{{ $nft->id }}">

        <label for="cTitle">nft title</label><br>
        <input type="text" id="cTitle" value="{{ $nft->title }}" name="nftTitle"><br>

        <label for="cDescription">nft description</label><br>
        <input type="text" id="cDescription" value="{{ $nft->description }}" name="nftDescription"><br>

        <input type="submit" name="upload" value="edit">

    </form>
</body>

</html>
