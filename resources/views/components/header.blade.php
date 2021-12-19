<header>
    <div class=search>
        <a href="/"><img src="{{ url('assets/atria_logo.svg') }}" alt="Logo Atria"></a>
        <form class="header" action="{{ url('/search') }}" type="get" autocomplete="off">
            <select name="category" id="category">
                <option value="Collections">Collections</option>
                <option value="NFTs">NFT's</option>

            </select>

            <input class="form-control-lg searchbar" type="search" id="search" name="searchTerm" placeholder="Search"
                aria-label="Search">
            <button class="btn btn--blue btn--h40 btn--search" type="submit">Go</button>
        </form>
    </div>

    <nav>
        <a href="/wallet">My wallet</a>
        <a href="/profile/#favorite">My favourites</a>
        <a class="btn btn--blue btn--h40 btn--signedin" href="/profile">{{ $firstname }}</a>

    </nav>
</header>
