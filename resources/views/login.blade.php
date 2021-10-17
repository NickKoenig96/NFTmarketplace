@extends('layouts/app')
@section('title', 'Login')

@section('content')



<div class="form__container">
    <img src="" alt="">
<form action="{{ url('/users/login') }}" method="POST" class="form">
    @csrf

    
    <input class="input input--light" type="text" placeholder="Email" name="email" id="email">

    <input class="input input--light" type="password" placeholder="Password" name="password" id="password">

    <input class="btn btn--light" type="submit"  value="Login">

    

</form>
</div>
@endsection