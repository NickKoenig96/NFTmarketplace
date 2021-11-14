@extends('layouts/app')
@section('title', 'Profile')

@section('content')
    <x-header firstname="{{ $user->firstname }}" />

    <section>

        @if ($flash = session('message'))
            @component('components/alert')
                @slot('type') succes @endslot
                <p> {{ $flash }}</p>
            @endcomponent

        @endif
    </section>
@endsection
