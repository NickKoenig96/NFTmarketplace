<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <form method="POST" action="/collection/addCollection" enctype='multipart/form-data'>
        @csrf
        <label for="cTitle">collection title</label><br>
        <input type="text" id="cTitle" name="collectionTitle"><br>

        <label for="cDescription">collection description</label><br>
        <input type="text" id="cDescription" name="collectionDescription"><br>

        <label for="cImage">collection image</label><br>
        <input type="file" name="collectionImage"> <br>
        <input type="submit" name="upload">

    </form>
</body>

</html>
