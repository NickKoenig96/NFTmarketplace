@extends('layouts/profile')


@section('content')
    <h1>Profile</h1>



    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <img src="../images/{{$user->avatar}}" alt="avatar">
                <p>{{$user->name}}</p>
            </div>
        </div>
    </div>
@endsection


