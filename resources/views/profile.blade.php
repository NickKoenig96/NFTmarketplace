@extends('layouts/app')
@section('title', 'Profile')

@section('content')
    <x-header firstname="{{ $user->name }}" />

    <h1 class="test">Profile</h1>

    <x-notification message="{{ $user->name }}" />


    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                
                <img src="http://localhost/images/{{ $user->avatar }}" alt="avatar" style="border-radius:50%;">
                <p>{{$user->name}}</p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <form  action="/profile/updateName" method="POST">
                @csrf
                    <label for="">Update name</label>
                    <input type="text" name="newName">
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <input type="submit" class="btn btn-small btn-primary" value="Send">
                    </form>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <form enctype="multipart/form-data"  action="/profile/updateAvatar" method="POST">
                @csrf
                    <label for="">Update Avatar</label>
                    <input type="file" name="avatar">
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <input type="submit" class="btn btn-small btn-primary" value="Send">
                    </form>
            </div>
        </div>
    </div>


@endsection


