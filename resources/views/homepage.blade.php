@extends('layouts/app')

@section('title', 'Home')


@section('content')


    <x-header firstname="{{ $user->firstname }}" />

    <section>


        <p>1 euro = {{ $eth }}ETH</p>
        <h1>Collections</h1>
        
        

        




        <div class="cardgallery">
            @foreach ($collections as $collection)
                <a class="card card--3col" href="/collections/{{ $collection->id }}">
                    <img class="card__image" src="{{ $collection->image_file_path }}" alt="collection image">
                    <img class="card__profilepicture--small" src="{{ $collection->creator->avatar }}" alt="creator image">
                    <div class="card__specs">
                        <!-- <div class="btn--favourite"></div> -->
                        <div class="btn--nftcount"><span> {{ $collection->nft()->count() }}</span></div>
                    </div>
                    <p class="card__title ta_c" style="margin-bottom: 12px;">{{ $collection->title }}</p>
                    <p class="card__description body--normal"> {{ $collection->description }}</p>
                </a>
            @endforeach
        </div>
        <div class="btn__container">
            <a class="btn btn--blue" href="/collections">See all collections</a>
        </div>
    </section>

    <section class="bg--2">
        <h1>NFT's</h1>
        <form action="{{ url('/homepageFilter') }}" type="get">
            <h2 class="form-group__title">Filter:</h2>
            <select class="filter" name="filter" id="filter">
                <option value="">Select</option>
                <option id="price" value="Price">Price</option>
                <option id="area" value="Area">Area</option>
                <option id="type" value="Type">Type</option>
            </select>
            <select name="option" id="option">
                {{-- options in javascript --}}
            </select>
            <button type="submit" class="btn--blue btn--h40 btn--center">Submit </button>
        </form>

        <div class="cardgallery">
            @foreach ($nfts as $nft)
                <div class="card card--3col flex--spbet">
                    <img id="nftImage" src="{{ $nft->image_file_path }}" alt="nft image" class="card__image card__image--large">
                    <div class="marginb-24">
                        <div class="flex--spbet">
                            <p class="card__title" style="margin-bottom: 0px;">{{ $nft->title }}</p>
                            {{-- <div class="btn--favourite"></div> --}}
                            @livewire("favorites", ['nftId' => $nft->id, 'userId' => $user->id])

                        </div>
                        <span class="card__price">€ {{ $nft->price }}</span>
                        <br>
                        <span data-token="{{$nft->token_id}}" class="card__price--eth">ETH {{ $eth * $nft->price }}</span>
                    </div>
                    <div class="flex--spbet">
                        <a href="/nfts/{{ $nft->id }}" class="btn btn--light btn--1col">View</a>
                        @if ($nft->forSale === 1 && $user->id != $nft->owner_id)
                            <a href="/nft/buy/{{ $nft->id }}" class="btn btn--blue btn--155">Buy</a>
                        @endif
                        @if ($nft->creator_id == $user->id)
                            @if($nft->minted == false)
                                <button data-owner="{{$nft->owner_id}}" data-price="{{$eth * $nft->price}}" data-id="{{$nft->id}}" data-hash="{{$nft->item_hash}}" data-image="{{$nft->image_file_path}}" class="btn--mint">Mint NFT</button>
                            @endif
                            @if ($nft->forSale === 0 && $nft->minted == true && $nft->creator_id == $nft->owner_id)
                                <a href="" id="sellBtn" data-id="{{ $nft->id }}" data-price="{{$eth * $nft->price }}" data-token="{{ $nft->token_id }}" class="btn btn--blue btn--155">Sell NFT</a>
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
                    sellBtn.addEventListener('click', async(e)=>{
                        e.preventDefault();
                        const provider = new ethers.providers.Web3Provider(window.ethereum);
                        const signer = provider.getSigner();
                        const contractAddress = "0x76d463D9CA4CAE1Fd478d62e9914A6b6Cc2b604e";
                        let Abi;
                        await fetch("/abi/NFT.json").then((res) => {return res.json();}).then((data) => {Abi = data;});
                        const contract = new ethers.Contract(contractAddress, Abi, provider);
                        let contractWithSigner = contract.connect(signer);

                        let id = sellBtn.dataset.id;
                        let tokenIdString = sellBtn.dataset.token;
                        let priceEth = sellBtn.dataset.price;
                        
                        let price = ethers.utils.parseUnits(priceEth, "ether");
                        let tokenId = ethers.BigNumber.from(tokenIdString);

                        const transaction = await contractWithSigner.putUpForSale(tokenId, price);
                        await transaction.wait().then(res => {
                        });

                        const forSale = await contract.isForSale(tokenId);

                        if(forSale){
                            //nft forSale zetten in database als de nft voor sale is in het contract
                            const form = document.createElement('form');
                            form.method = 'POST';

                            let csrf_token = "{{csrf_token()}}";
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
                    mintNftBtns.forEach((mintNftBtn)=>{
                        mintNftBtn.addEventListener('click', async(e)=>{
                            e.preventDefault();
                            const provider = new ethers.providers.Web3Provider(window.ethereum);
                            const signer = provider.getSigner();
                            const contractAddress = "0x76d463D9CA4CAE1Fd478d62e9914A6b6Cc2b604e";
                            let Abi;
                            await fetch("/abi/NFT.json").then((res) => {return res.json();}).then((data) => {Abi = data;});
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
                                let tokenIdString = res['events'][0]['topics'][3]; //returns string with tokenId as hexadecimal
                                tokenId = ethers.BigNumber.from(tokenIdString).toString(); //puts string in a BigNumber, and converts it to a readable tokenId
                            });

                            // send a post 
                            const form = document.createElement('form');
                            form.method = 'POST';

                            let csrf_token = "{{csrf_token()}}";
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
                ethPrices.forEach(async(ethPrice)=> {
                    // set here the tokenid that gived isforsale
                    const provider = new ethers.providers.Web3Provider(window.ethereum);
                    const contractAddress = "0x76d463D9CA4CAE1Fd478d62e9914A6b6Cc2b604e";
                    let Abi;
                    await fetch("/abi/NFT.json").then((res) => {return res.json();}).then((data) => {Abi = data;});
                    const contract = new ethers.Contract(contractAddress, Abi, provider);

                    let tokenId = ethPrice.dataset.token;
                    let price = await contract.getPrice(tokenId);
                    let priceToEth = ethers.utils.formatEther(price);

                    ethPrice.innerHTML = "ETH " + priceToEth;
                });
            </script>
        </div>

    </section>


    <script src="{{ url('js/app.js') }}"></script> 

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

        function priceVisible(){
            option.innerHTML = `<option value="">Select</option>`;
            option.innerHTML += `<option id="PriceLH" value="PriceLH">Price LOW to HIGH</option>`;
            option.innerHTML += `<option id="HLPrice" value="PriceHL">Price HIGH to LOW</option>`;
        }

        function areaVisible(){
            option.innerHTML = `<option value="">Select</option>`;
            option.innerHTML += `<option id="AreaLH" value="AreaLH">Area LOW to HIGH</option>`;
            option.innerHTML += `<option id="HLArea" value="AreaHL">Area HIGH to LOW</option>`;
        }

        function typeVisible(){
            option.innerHTML = `<option value="">Select</option>`;
            option.innerHTML += `<option id="TypeAZ" value="TypeAZ">Object type title (A-Z)</option>`;
            option.innerHTML += `<option id="ZAType" value="TypeZA">Object type title (Z-A)</option>`;
        }
       

        let filter = document.getElementById("filter");

        filter.addEventListener("change", function(e) {
            let selectedIndex = filter.selectedIndex;
            let selectedValue = filter[selectedIndex].value;
            console.log(selectedValue);

            if(selectedValue == 'Price'){
                option.style.display = "inline-block";
                priceVisible();
            }else if(selectedValue == "Area"){
                option.style.display = "inline-block";
                areaVisible();
            }else if(selectedValue == "Type"){
                option.style.display = "inline-block";
                typeVisible();
            }else{
                option.style.display = "none";
            }
        });
    </script>

@endsection
