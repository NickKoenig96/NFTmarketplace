@extends('layouts/app')
@section('title', 'Profile')

@section('content')
    <x-header firstname="{{ $user->firstname }}" />
        @if ($flash = session('message'))
            @component('components/alert')
                @slot('type') succes @endslot
                <p> {{ $flash }}</p>
            @endcomponent
        @endif

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

    <section>
        <h1>Profile</h1>


        <div class="cards">
            <div class="card card--profile">
                <p class="card__title">Your profile</p>

                <img class="card__profilepicture" src="{{ $user->avatar }}" alt="avatar">
                <p class="body--normal bold"><span>{{ $user->firstname }}</span> <span>{{ $user->lastname }}</span></p>
                <blockquote class="body--tiny card__biography">{{ $user->bio }}</blockquote>
                <div class="card--profile__totals">
                    <div class="userCollections">
                        <h3>{{ $collections->count() }}</h3>
                        <span class="body--tiny black--60">Collections</span>
                    </div>
                    <div class="usernfts">
                        <h3>{{ $nfts->count() }}</h3>
                        <span class="body--tiny black--60">NFT's</span>
                    </div>
                </div>
                <form enctype="multipart/form-data" action="/profile/updateAvatar" method="POST">
                    <div class="form__control--small">
                        <input class="hidden fileSelect" type="file" name="avatar">
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <input type="submit" class="btn btn--blue btn--h40" value="Upload new avatar">
                    </div>
                    @csrf
                </form>
                <a href="#" class="btn btn--blue btn--h40 btn--destroy--plain">Delete avatar</a>
            </div>


            <div class="card card--edit">
                <p class="card__title">Edit your personal settings</p>
                <form action="/profile/updateUserdata" method="POST">
                    @csrf
                    <div class="twocol" style="height: 332px; margin-top:40px; margin-bottom: 40px;">
                        <div class="form__control">
                            <label for="firstname">Firstname</label>
                            <input type="text" id="firstname" name="firstname" placeholder="{{ $user->firstname }}"
                                value="{{ $user->firstname }}">
                        </div>
                        <div class="form__control">
                            <label for="lastname">Lastname</label>
                            <input type="text" id="lastname" name="lastname" placeholder="{{ $user->lastname }}"
                                value="{{ $user->lastname }}">
                        </div>
                        <div class="form__control">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="{{ $user->email }}"
                                value="{{ $user->email }}">
                        </div>
                    </div>
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <input type="submit" class="btn btn--blue btn--h40 mcenter" value="Update information">
                </form>
            </div>


            <div class="card card--edit">
            <p class="card__title">Edit your password</p>
            <form action="/profile/updateUserPassword" method="POST">
                    @csrf
                    <div class="twocol" style="height: 332px; margin-top:40px; margin-bottom: 40px;">
                    <div class="form__control">
                            <label for="password">Old password</label>
                            <input type="password" id="password" name="password" placeholder="••••••••••••">
                    </div>
                    <div class="form__control">
                            <label for="newPassword">New password</label>
                            <input type="password" id="newPassword" name="newPassword" placeholder="••••••••••••">
                    </div>
                    <div class="form__control">
                            <label for="password">Confirm new password</label>
                            <input type="password" id="confirmPassword" name="newPassword_confirmation" placeholder="••••••••••••">
                    </div>
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <input type="hidden" name="email" value="{{ $user->email }}">
                    <input type="submit" class="btn btn--blue btn--h40 mcenter" value="Update password">
            </div>
            </form>
            </div>
        </div>
        </div>
    </section>

    <div class=" btn__container btn--logout__container">
        <a class="btn btn--red" href="./logout">Logout</a>
    </div>

    <section class="bg--2">
        <h1>My NFT's and collections</h1>


        <h3 class="medium hr black--60 marginb-24">{{ count($nfts) }} Owned NFT's</h3>
        <div class="cardgallery">
            @foreach ($nfts as $nft)
                <div class="card card--3col flex--spbet">
                    <img src="{{ $nft->image_file_path }}" alt="nft image" class="card__image card__image--large">
                    <div class="marginb-24">
                        <div class="flex--spbet">
                            <p class="card__title" style="margin-bottom: 0px;">{{ $nft->title }}</p>
                            <div class="btn--favourite"></div>
                        </div>
                        <span class="card__price">€ {{ $nft->price }}</span>
                    </div>
                    <div class="flex--spbet">
                        <a href="/nfts/{{ $nft->id }}" class="btn btn--light btn--1col">View</a>
                        <a href="/nfts/{{ $nft->id }}" class="btn btn--blue btn--155">Buy</a>
                    </div>
                </div>
            @endforeach
        </div>

        <h3 class="medium hr black--60 marginb-24">{{ count($collections) }} Created collections</h3>
        <div class="cardgallery">
            @foreach ($collections as $collection)
                <a class="card card--3col" href="/collections/{{ $collection->id }}">
                    <img class="card__image" src="{{ $collection->image_file_path }}" alt="collection image">
                    <img class="card__profilepicture--small" src="{{ $collection->creator->avatar }}"
                        alt="creator image">
                    <div class="card__specs">
                        <!-- <div class="btn--favourite"></div> -->
                        <div class="btn--nftcount"><span> {{ $collection->nft()->count() }}</span></div>
                    </div>
                    <p class="card__title ta_c" style="margin-bottom: 12px;">{{ $collection->title }}</p>
                    <p class="card__description body--normal"> {{ $collection->description }}</p>
                </a>
            @endforeach
        </div>

        <!-- Momenteel dezelfde output als bij de "owned NFT's" -->
        <h3 class="medium hr black--60 marginb-24">
            {{ count($favorites) }} Favourite nft's
        </h3>
        <div id="favorite" class="cardgallery">
            @foreach ($favorites as $favorite)
                <div class="card card--3col flex--spbet">
                    <img src="{{ $favorite->nft->image_file_path }}" alt="nft image" class="card__image card__image--large">
                    <div class="marginb-24">
                        <div class="flex--spbet">
                            <p class="card__title" style="margin-bottom: 0px;">{{ $favorite->nft->title }}</p>
                            <div class="btn--favourite--true"></div>
                        </div>
                        <span class="card__price">€ {{ $favorite->nft->price }}</span>
                    </div>
                    <div class="flex--spbet">
                        <a href="/nfts/{{ $favorite->nft->id }}" class="btn btn--light btn--1col">View</a>
                        <a href="/nfts/{{ $favorite->nft->id }}" class="btn btn--blue btn--155">Buy</a>
                    </div>
                </div>
            @endforeach
        </div>

    </section>

    <script>
        document.querySelector('.card__profilepicture').addEventListener('click', function(e) {
            e.preventDefault();
            fileSelect.click();
        });

        let fileSelect = document.querySelector('.fileSelect');
        fileSelect.addEventListener("change", function(f) {
            let preview = document.querySelector('.prev').addEventListener('click', function(e) {
                console.log('changed');
            })
        });
    </script>


@endsection
