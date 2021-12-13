@extends('layouts/app')

@section('content')

    <div
        style='width: 60em; background-color: rgb(22,44,153); padding: 25px; margin-left:auto; margin-right:auto; margin-top:2em;'>
        <h1 style='color: #ffffff;'>Hey, {{ $user->firstname }} your nft {{ $nft->title }} has just been sold on Atria
            for {{ $nft->price }} € </h1>
        <img style='width: 25em; margin-left:25%; margin-right:25%; margin-top:1em; border: 2px solid rgb(255, 255, 255); border-radius: 10%;'
            src="{{ $nft->image_file_path }}" alt="nft image">
        <p style='color: #ffffff;'>check it out on <a href="https://atria.spacetechnology.net/login">atria.net website</a>
        </p>
    </div>


@endsection
