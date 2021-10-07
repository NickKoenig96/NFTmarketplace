<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <form method="POST" action="/collection/removeCollection" enctype='multipart/form-data'>
        @csrf
        @method('DELETE')
        <label for="cTitle">collection title</label><br>
        <input type="text" id="cTitle" name="collectionTitle"><br>
        <input type="submit" name="remove">

    </form>
</body>

</html>
