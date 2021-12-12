@extends('layouts/app')
@section('title', 'Login')

@section('content')

@if($errors->any())
    @component('components/alert')
        @slot('type') danger @endslot
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endcomponent
@endif

@if($flash = session('error'))
@component('components/alert')
        @slot('type') danger @endslot
        <ul>
            <li>{{ $flash }}</li>
        </ul>
    @endcomponent
@endif

<div class="form__container">
    <img class="form__img"  src="{{ url('assets/atria_logo.svg') }}" alt="Logo Atria">
<form action="{{ url('/users/login') }}" method="POST" class="form">
    @csrf
    
    <input value="{{ old('email') }}" class="input input--light" type="text" placeholder="Email" name="email" id="email">

    <input class="input input--light" type="password" placeholder="Password" name="password" id="password">

    <input class=" btn--login" type="submit"  value="Login">

    <a class="form__link" href="/signup">New user? Create an account</a>

    

</form>



</div>
@endsection