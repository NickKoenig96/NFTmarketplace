@extends('layouts/app')
@section('title', 'Signup')

@section('content')


<h1>Signup</h1>

<form action="{{ url('/users/signup') }}" method="POST">
    @csrf
    <label for="firstname">Firstname</label>
    <input type="text" placeholder="Firstname" name="firstname" id="firstname">

    <label for="lastname">Lastname</label>
    <input type="text" placeholder="Lastname" name="lastname" id="lastname">

    <label for="email">Email</label>
    <input type="text" placeholder="Email" name="email" id="email">

    <label for="password">Password</label>
    <input type="password" placeholder="Password" name="password" id="password">

    <label for="phone">Phone</label>
    <input type="text" placeholder="Phone" name="phone" id="phone">

    <label for="bio">Bio</label>
    <textarea name="bio" id="bio" cols="30" rows="10"></textarea>

    <label for="street">Street</label>
    <input type="text" placeholder="Street" name="street" id="street">

    <label for="housenumber">housenumber</label>
    <input type="text" placeholder="Housenumber" name="housenumber" id="housenumber">

    <label for="city">City</label>
    <input type="text" placeholder="City" name="city" id="city">

    <label for="postal">Postalcode</label>
    <input type="text" placeholder="Postalcode" name="postal" id="postal">

    <label for="country">Country</label>
    <input type="text" placeholder="Country" name="country" id="country">

    <input type="submit"  value="Signup">

    

</form>

@endsection