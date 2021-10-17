<header>
    <img src="{{ url('assets/atria_logo.svg') }}" alt="Logo Atria">
    <input class="searchbar" type="text" placeholder="What space image are you looking for today?">
    <nav>
        <a href="#">My wallets</a>
        <a href="#">My favourites</a>
        <a href="#">About us</a>
        <a href="#">Contact</a>
        <a class="btn btn--signedin" href="#">{{ $firstname ?? '' }}</a>
    </nav>
</header>