@extends('layouts/app')
@section('title', 'Profile')

@section('content')
    <x-header firstname="{{ $user->firstname }}" />
    
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
                        <h3>2</h3>
                        <span class="body--tiny black--60">Collections</span>
                    </div>
                    <div class="usernfts">
                        <h3>15</h3>
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
                            <label for="firstname">firstname</label>
                            <input type="text" id="firstname" name="firstname" placeholder="{{ $user->firstname }}"
                                value="{{ $user->firstname }}">
                        </div>
                        <div class="form__control">
                            <label for="lastname">lastname</label>
                            <input type="text" id="lastname" name="lastname" placeholder="{{ $user->lastname }}"
                                value="{{ $user->lastname }}">
                        </div>
                        <div class="form__control">
                            <label for="email">email</label>
                            <input type="email" id="email" name="email" placeholder="{{ $user->email }}"
                                value="{{ $user->email }}">
                        </div>
                        <div class="form__control">
                            <label for="password">password</label>
                            <input type="password" id="password" name="password" placeholder="••••••••••••">
                        </div>
                        <div class="form__control--double">
                            <div class="form__control form__control--small">
                                <label for="street">street</label>
                                <input type="text" id="street" name="street" placeholder="{{ $user->street }}"
                                    value="{{ $user->street }}">
                            </div>
                            <div class="form__control form__control--smaller">
                                <label for="housenumber">housenumber</label>
                                <input type="text" id="housenumber" name="housenumber" placeholder="{{ $user->housenumber }}"
                                    value="{{ $user->housenumber }}">
                            </div>
                        </div>
                        <div class="form__control--double">
                            <div class="form__control form__control--small">
                                <label for="city">city</label>
                                <input type="text" id="city" name="city" placeholder="{{ $user->city }}"
                                    value="{{ $user->city }}">
                            </div>
                            <div class="form__control form__control--smaller">
                                <label for="postal">postal</label>
                                <input type="text" id="postal" name="postal" placeholder="{{ $user->postal }}"
                                    value="{{ $user->postal }}">
                            </div>
                        </div>
                        <div class="form__control">
                            <label for="country">country</label>
                            <input type="text" id="country" name="country" placeholder="{{ $user->country }}"
                                value="{{ $user->country }}">
                        </div>
                        <div class="form__control">
                            <label for="phone">phone</label>
                            <input type="text" id="phone" name="phone" placeholder="{{ $user->phone }}"
                                value="{{ $user->phone }}">
                        </div>
                    </div>
                    <input type="hidden" name="id" value="{{ $user->id }}">

                    <input type="submit" class="btn btn--blue btn--h40 mcenter" value="Update information">
                </form>
            </div>
        </div>
        </div>
    </section>

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
                <img class="card__image" src="{{ $collection->image_file_path}}" alt="collection image">
                <img class="card__profilepicture--small" src="{{ $collection->image_file_path }}" alt="creator image">
                <div class="card__specs">
                    <!-- <div class="btn--favourite"></div> -->
                    <div class="btn--nftcount"><span>5</span></div>
                </div>
                <p class="card__title ta_c" style="margin-bottom: 12px;">{{ $collection->title }}</p>
                <p class="card__description body--normal"> {{ $collection->description }}</p>
            </a>
            @endforeach
        </div>

        <!-- Momenteel dezelfde output als bij de "owned NFT's" -->
        <h3 class="medium hr black--60 marginb-24"><!--{{ count($collections) }}-->4 Favourite nft's</h3>
        <div class="cardgallery">
            @foreach ($nfts as $nft)
                <div class="card card--3col flex--spbet">
                    <img src="{{ $nft->image_file_path }}" alt="nft image" class="card__image card__image--large">
                    <div class="marginb-24">
                    <div class="flex--spbet">
                        <p class="card__title" style="margin-bottom: 0px;">{{ $nft->title }}</p>
                        <div class="btn--favourite--true"></div>
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
