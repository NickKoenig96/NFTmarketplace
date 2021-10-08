<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <form method="POST" action="/nft/addNft">
        @csrf
        <label for="nTitle">nft title</label><br>
        <input type="text" id="nTitle" name="nftTitle"><br>

        <label for="nDescription">nft description</label><br>
        <input type="text" id="nDescription" name="nftDescription"><br>

        <label for="collection_id">collection_id</label><br>
        <input type="text" id="collection_id" name="collection_id"><br>

        <input type="submit" name="upload" value="add">

    </form>
</body>

</html>
