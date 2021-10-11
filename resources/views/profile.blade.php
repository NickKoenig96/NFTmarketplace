@extends('layouts/profile')


@section('content')
    <h1>Profile</h1>



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


