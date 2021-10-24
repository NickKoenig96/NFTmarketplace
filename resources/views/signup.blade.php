@extends('layouts/app')
@section('title', 'Signup')

@section('content')



<div class="form__container">
    
    <img class="form__img"  src="{{ url('assets/atria_logo.svg') }}" alt="Logo Atria">
    
<form action="{{ url('/users/signup') }}" method="POST" class="form">
    @csrf
    
    <input class="input input--light" type="text" placeholder="Firstname" name="firstname" id="firstname">

    
    <input class="input input--light" type="text" placeholder="Lastname" name="lastname" id="lastname">

    
    <input class="input input--light" type="text" placeholder="Username" name="username" id="username">


    <input class="input input--light" type="text" placeholder="Email" name="email" id="email">

    
    <input class="input input--light" type="password" placeholder="Password" name="password" id="password">

    
    <input class="input input--light" type="password" placeholder="Confirm Password" name="confirmPassword" id="confirmPassword">


    <input class="btn btn--light" type="submit"  value="Signup">

    

</form>
</div>
@endsection