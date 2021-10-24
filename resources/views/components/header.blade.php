<header>
    <div class=search>
        <img src="{{ url('assets/atria_logo.svg') }}" alt="Logo Atria">
        <form action="{{ url('/search') }}" type="get" autocomplete="off">
            <select name="category" id="category">
                <option value="Collections">Collections</option>
                <option value="NFT's">NFT's</option>

            </select>

            <input class="form-control-lg searchbar" type="search" id="search" name="searchTerm" placeholder="Search"
                aria-label="Search">
            <button class="btn btn--search" type="submit">Go</button>
        </form>
    </div>

    <nav>
        <a href="#">My wallets</a>
        <a href="#">My favourites</a>
        <a href="#">About us</a>
        <a href="#">Contact</a>
        <a class="btn btn--signedin" href="#">{{ $firstname }}</a>
    </nav>
</header>