@extends('layouts/app')
@section('title', 'NFT')

@section('content')
    <x-header firstname="{{ $user->firstname }}" />

    <section>
        <p>1 euro = {{ $eth }}ETH</p>

        @if ($flash = session('message'))
            @component('components/alert')
                @slot('type') succes @endslot
                <p> {{ $flash }}</p>
            @endcomponent

        @endif

        <div class="flex flex--start flex--gap40">
            <div class="card pad-5perc">
                <img class="card__image--35vw" src="{{ $nft->image_file_path }}" alt="nft image"
                    class="card__image card__image--large">
            </div>
            <div class="nft__details flex--col flex--spbet">
                <div>
                    <h1>{{ $nft->title }}</h1>
                    <h4 class="blue--20">Owner: {{ $nft->owner->firstname . ' ' . $nft->owner->lastname }}</h4>
                    <div class="margint-12 flex flex--alcen">
                        @livewire("favorites", ['nftId' => $nft->id, 'userId' => $user->id])
                        <h5 class="blue--20 marginl-12">favourite</h5>
                    </div>
                    <h1 class="margint-48">&euro; {{ $nft->price }} <span class="marginl-24 body--normal">ETH
                            {{ $nft->price * $eth }}</span></h1>

                    <h3>Description</h3>
                    <p>{{ $nft->description }}</p>
                </div>
                <!-- juist ifloop voor de sales -->
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
        <h1>Comments</h1>
        <!-- <form method="post" action="{{ url('/comment/store') }}">
                    @csrf
                    <div class="comment marginb-24 flex flex--start flex--gap40">
                        <div class="form__control--80perc">
                            <input type="text" id="comment" name="comment" placeholder="Your comment">
                        </div>
                        <input type="hidden" id="nft_id" name="nft_id" value="{{ $nft->id }}">
                        <input type="hidden" id="user_id" name="user_id" value="{{ $user->id }}">
                        <div class="form__control--smaller">
                            <input  type="submit" value="Post">
                        </div>
                    </div>
                </form> -->


        @livewire("new-comment", ['nftId' => $nft->id, 'userId' => $user->id, 'userFirstname' => $user->firstname,
        'userLastname' => $user->lastname])
        @livewire("all-comments", ['nftId' => $nft->id, 'userId' => $user->id, 'userFirstname' => $user->firstname,
        'userLastname' => $user->lastname])


        <!-- <ul>
                    @foreach ($comments as $comment)
                        <li class="comment">
                            <p class="comment__user">{{ $comment->user->firstname . ' ' . $comment->user->lastname }}</p>
                            <p class="comment__text">{{ $comment->text }}</p>
                            <div class="comment__details flex flex--start flex--gap40">
                                <p>Delete</p>
                            </div>
                        </li>
                    @endforeach
                </ul> -->
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

        let option = document.getElementById("option");
        option.style.display = "none";

        function priceVisible() {
            option.innerHTML = `<option value="">Select</option>`;
            option.innerHTML += `<option id="PriceLH" value="PriceLH">Price LOW to HIGH</option>`;
            option.innerHTML += `<option id="HLPrice" value="PriceHL">Price HIGH to LOW</option>`;
        }

        function areaVisible() {
            option.innerHTML = `<option value="">Select</option>`;
            option.innerHTML += `<option id="AreaLH" value="AreaLH">Area LOW to HIGH</option>`;
            option.innerHTML += `<option id="HLArea" value="AreaHL">Area HIGH to LOW</option>`;
        }

        function typeVisible() {
            option.innerHTML = `<option value="">Select</option>`;
            option.innerHTML += `<option id="TypeAZ" value="TypeAZ">Object type title (A-Z)</option>`;
            option.innerHTML += `<option id="ZAType" value="TypeZA">Object type title (Z-A)</option>`;
        }


        let filter = document.getElementById("filter");

        filter.addEventListener("change", function(e) {
            let selectedIndex = filter.selectedIndex;
            let selectedValue = filter[selectedIndex].value;
            console.log(selectedValue);

            if (selectedValue == 'Price') {
                option.style.display = "inline-block";
                priceVisible();
            } else if (selectedValue == "Area") {
                option.style.display = "inline-block";
                areaVisible();
            } else if (selectedValue == "Type") {
                option.style.display = "inline-block";
                typeVisible();
            } else {
                option.style.display = "none";
            }
        });
    </script>
@endsection
