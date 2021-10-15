@extends('layouts/app')
@section('title', 'Login')

@section('content')


<h1>Login</h1>

<form action="{{ url('/users/login') }}" method="POST">
    @csrf

    <label for="email">Email</label>
    <input type="text" placeholder="Email" name="email" id="email">

    <label for="password">Password</label>
    <input type="password" placeholder="Password" name="password" id="password">

    <input type="submit"  value="Login">

    

</form>

@endsection