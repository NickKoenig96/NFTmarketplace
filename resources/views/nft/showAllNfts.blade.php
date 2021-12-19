@extends('layouts/app')
@section('title', 'NFT')

@section('content')
    <x-header firstname="{{ $user->firstname }}" />

    <section>
        <p class="info--eth">1 euro = {{ $eth }}ETH</p>

        @if ($flash = session('message'))
            @component('components/alert')
                @slot('type') succes @endslot
                <p> {{ $flash }}</p>
            @endcomponent

        @endif

        <div class="flex flex--start flex--gap40">
            <div class="card pad-5perc">
                <img class="card__image--35vw" src="{{ $nft->image_file_path }}" alt="nft image" class="card__image card__image--large">
            </div>
            <div class="nft__details flex--col flex--spbet">
                <div>
                    <div class="margint-12 flex flex--alcen">
                        <h1 class="card__title--headerOne">{{ $nft->title }}</h1>
                    </div>
                    <div class="margint-12 flex flex--alcen">
                        <h3 class="blue--20--owner">Owner: {{ $nft->owner->firstname . ' ' . $nft->owner->lastname }}</h3>
                        @livewire("favorites", ['nftId' => $nft->id, 'userId' => $user->id])
                        <h4 class="blue--20--favourite">favourite</h4>
                    </div>
                    <div class="margint-12 flex flex--alcen">
                        <h4> &euro; {{ $nft->price }} 
                            <span class="marginl-24 body--normal">ETH{{ $nft->price * $eth }}</span>
                        </h4>
                    </div>
                    <div class="margint-12 flex flex--alcen">
                        <h3>Description</h3>
                    </div>
                    <div class="margint-12 flex flex--alcen">
                        <p>{{ $nft->description }}</p>
                    </div>
                </div>
                <!-- juist ifloop voor de sales -->
                <div class="margint-12 flex flex--alcen">
                    @if($nft->creator_id === $user->id)
                        @if($nft->minted === 0)
                            <button data-owner="{{$nft->owner_id}}" data-price="{{$eth * $nft->price}}" data-id="{{$nft->id}}" data-hash="{{$nft->item_hash}}" data-image="{{$nft->image_file_path}}" class="btn--mint">Mint NFT</button>
                        @endif
                    @endif
                    @if($nft->owner_id === $user->id && $nft->minted === 1)
                        @if($nft->forSale === 0)
                            <a href="" id="sellBtn" data-id="{{ $nft->id }}" data-price="{{$eth * $nft->price }}" data-token="{{ $nft->token_id }}" class="btn btn--blue btn--155">Sell NFT</a>
                        @elseif($nft->forSale === 1)
                            <p style="display:block" class="info">Your NFT is for sale</p>
                        @endif
                    @endif

                    @if($nft->owner_id != $user->id && $nft->forSale === 1 && $nft->minted === 1)
                        <a href="/nft/buy/{{ $nft->id }}" class="btn btn--blue btn--155">Buy</a>
                    @endif
                </div>
            </div>
        </div>
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
                            console.log(res);
                            let tokenIdString = res['events'][0]['topics'][3]; //returns string with tokenId as hexadecimal
                            console.log(tokenIdString);
                            tokenId = ethers.BigNumber.from(tokenIdString).toString(); //puts string in a BigNumber, and converts it to a readable tokenId
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
    </section>

    <section class="bg--2">
        <h1 class="card__title--headerSecond">Comments</h1>

        @livewire("new-comment", ['nftId' => $nft->id, 'userId' => $user->id, 'userFirstname' => $user->firstname,
        'userLastname' => $user->lastname])
        @livewire("all-comments", ['nftId' => $nft->id, 'userId' => $user->id, 'userFirstname' => $user->firstname,
        'userLastname' => $user->lastname])

    </section>

    <script>
        var path = "{{ url('homepage/action') }}";

        $('#search').typeahead({


            source: function(query, process) {

                return $.get(path, {
                    term: query,
                    category: $("select#category").val()

                }, function(data) {
                    return process(data);

                });

            }

        });
    </script>
@endsection
