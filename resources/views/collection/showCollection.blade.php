@extends('layouts/app')
@section('title', 'Collection')

@section('content')
    <x-header firstname="{{ $user->firstname }}" />

    <section>

        <h1>{{ $collection->title }}</h1>

        @if ($flash = session('message'))
            @component('components/alert')
                @slot('type') succes @endslot
                <p> {{ $flash }}</p>
            @endcomponent

        @endif

        <div class="flex flex--start flex--gap40">
            <div class="card pad-5perc">
                <img class="card__image--35vw" src="{{ $collection->image_file_path }}" alt="collection image"
                    class="card__image card__image--large">
            </div>
            <div class="nft__details flex--col flex--spbet">
                <div>
                    <h1>{{ $collection->title }}</h1>
                    <h4 class="blue--20">Creator:
                        {{ $collection->creator->firstname . ' ' . $collection->creator->lastname }}</h4>
                    <div class="margint-12 flex flex--alcen">
                        <!-- <div class="btn--view"></div><h5 class="blue--20 marginr-48 marginl-12">11k Views</h5> -->
                        <!-- <a href="#" class="btn--favourite btn--favourite--small"></a><h5 class="blue--20 marginl-12">favourite</h5> -->
                    </div>

                    <h3>Description</h3>
                    <p>{{ $collection->description }}</p>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="cardgallery">
            @foreach ($nfts as $nft)
                <div class="card card--3col flex--spbet">
                    <img id="nftImage" src="{{ $nft->image_file_path }}" alt="nft image"
                        class="card__image card__image--large">
                    <div class="marginb-24">
                        <div class="flex--spbet">
                            <p class="card__title" style="margin-bottom: 0px;">{{ $nft->title }}</p>
                            {{-- <div class="btn--favourite"></div> --}}
                            @livewire("favorites", ['nftId' => $nft->id, 'userId' => $user->id])

                        </div>
                        <span class="card__price">€ {{ $nft->price }}</span>
                        <br>
                        <span data-token="{{ $nft->token_id }}" class="card__price--eth">ETH
                            {{ $eth * $nft->price }}</span>
                    </div>
                    <div class="flex--spbet">
                        <a href="/nfts/{{ $nft->id }}" class="btn btn--light btn--1col">View</a>
                        @if ($nft->forSale === 1 && $user->id != $nft->owner_id)
                            <a href="/nft/buy/{{ $nft->id }}" class="btn btn--blue btn--155">Buy</a>
                        @endif
                        @if ($nft->creator_id == $user->id)
                            @if ($nft->minted == false)
                                <button data-owner="{{ $nft->owner_id }}" data-price="{{ $eth * $nft->price }}"
                                    data-id="{{ $nft->id }}" data-hash="{{ $nft->item_hash }}"
                                    data-image="{{ $nft->image_file_path }}" class="btn--mint">Mint NFT</button>
                            @endif
                            @if ($nft->forSale === 0 && $nft->minted == true && $nft->creator_id == $nft->owner_id)
                                <a href="" id="sellBtn" data-id="{{ $nft->id }}"
                                    data-price="{{ $eth * $nft->price }}" data-token="{{ $nft->token_id }}"
                                    class="btn btn--blue btn--155">Sell NFT</a>
                            @elseif($nft->forSale === 1)
                                <p class="info">Your NFT is for sale</p>
                            @endif
                        @elseif($nft->creator != $user && $nft->minted == 0 && $nft->forsale == 0)
                            <p class="info">This NFT has not been minted yet</p>

                            @if ($nft->forSale === 0)
                                <p class="info">This NFT is not for sale right now</p>
                            @endif
                        @endif
                    </div>
                </div>
            @endforeach

            <script type="text/javascript">
                let sellBtns = document.querySelectorAll('#sellBtn');

                sellBtns.forEach((sellBtn) => {
                    sellBtn.addEventListener('click', async (e) => {
                        e.preventDefault();
                        const provider = new ethers.providers.Web3Provider(window.ethereum);
                        const signer = provider.getSigner();
                        const contractAddress = "0x76d463D9CA4CAE1Fd478d62e9914A6b6Cc2b604e";
                        let Abi;
                        await fetch("/abi/NFT.json").then((res) => {
                            return res.json();
                        }).then((data) => {
                            Abi = data;
                        });
                        const contract = new ethers.Contract(contractAddress, Abi, provider);
                        let contractWithSigner = contract.connect(signer);

                        let id = sellBtn.dataset.id;
                        let tokenIdString = sellBtn.dataset.token;
                        let priceEth = sellBtn.dataset.price;

                        let price = ethers.utils.parseUnits(priceEth, "ether");
                        let tokenId = ethers.BigNumber.from(tokenIdString);

                        const transaction = await contractWithSigner.putUpForSale(tokenId, price);
                        await transaction.wait().then(res => {});

                        const forSale = await contract.isForSale(tokenId);

                        if (forSale) {
                            //nft forSale zetten in database als de nft voor sale is in het contract
                            const form = document.createElement('form');
                            form.method = 'POST';

                            let csrf_token = "{{ csrf_token() }}";
                            const hiddencsrf = document.createElement('input');
                            hiddencsrf.type = 'hidden';
                            hiddencsrf.name = "_token";
                            hiddencsrf.value = csrf_token;

                            const idInput = document.createElement('input');
                            idInput.type = 'hidden';
                            idInput.name = "id";
                            idInput.value = id;

                            form.appendChild(hiddencsrf);
                            form.appendChild(idInput);
                            document.body.appendChild(form);
                            form.action = `/nft/markForSale`;
                            form.submit();
                        }
                    })
                })
            </script>

            <script type="text/javascript">
                let mintNftBtns = document.querySelectorAll(".btn--mint");
                mintNftBtns.forEach((mintNftBtn) => {
                    mintNftBtn.addEventListener('click', async (e) => {
                        e.preventDefault();
                        const provider = new ethers.providers.Web3Provider(window.ethereum);
                        const signer = provider.getSigner();
                        const contractAddress = "0x76d463D9CA4CAE1Fd478d62e9914A6b6Cc2b604e";
                        let Abi;
                        await fetch("/abi/NFT.json").then((res) => {
                            return res.json();
                        }).then((data) => {
                            Abi = data;
                        });
                        const contract = new ethers.Contract(contractAddress, Abi, provider);
                        let contractWithSigner = contract.connect(signer);

                        let id = mintNftBtn.dataset.id;
                        let priceEth = mintNftBtn.dataset.price;
                        let media_file = mintNftBtn.dataset.image;
                        let nftOwnerString = mintNftBtn.dataset.owner;
                        let price = ethers.utils.parseUnits(priceEth, "ether");

                        let nftOwner = parseInt(nftOwnerString);

                        let tokenId;
                        const transaction = await contractWithSigner.mintNFT(media_file, price);
                        await transaction.wait().then(res => {
                            let tokenIdString = res['events'][0]['topics'][
                            3]; //returns string with tokenId as hexadecimal
                            tokenId = ethers.BigNumber.from(tokenIdString)
                        .toString(); //puts string in a BigNumber, and converts it to a readable tokenId
                        });

                        // send a post 
                        const form = document.createElement('form');
                        form.method = 'POST';

                        let csrf_token = "{{ csrf_token() }}";
                        const hiddencsrf = document.createElement('input');
                        hiddencsrf.type = 'hidden';
                        hiddencsrf.name = "_token";
                        hiddencsrf.value = csrf_token;

                        form.appendChild(hiddencsrf);
                        document.body.appendChild(form);
                        form.action = `/nft/${tokenId}/${nftOwner}/${id}`;
                        form.submit();
                    });
                })
            </script>
            <script type="text/javascript">
                // getPrice contract web3
                let ethPrices = document.querySelectorAll(".card__price--eth");
                ethPrices.forEach(async (ethPrice) => {
                    // set here the tokenid that gived isforsale
                    const provider = new ethers.providers.Web3Provider(window.ethereum);
                    const contractAddress = "0x76d463D9CA4CAE1Fd478d62e9914A6b6Cc2b604e";
                    let Abi;
                    await fetch("/abi/NFT.json").then((res) => {
                        return res.json();
                    }).then((data) => {
                        Abi = data;
                    });
                    const contract = new ethers.Contract(contractAddress, Abi, provider);

                    let tokenId = ethPrice.dataset.token;
                    let price = await contract.getPrice(tokenId);
                    let priceToEth = ethers.utils.formatEther(price);

                    ethPrice.innerHTML = "ETH " + priceToEth;
                });
            </script>
        </div>



    </section>
@endsection
