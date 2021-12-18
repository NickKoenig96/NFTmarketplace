@extends('layouts/app')
@section('title', 'Buy ')

@section('content')

    <p>{{ $nft->title }}</p>
    <p>{{ $nft->description }}</p>
    <span data-token="{{ $nft->token_id }}" class="card__price--eth">ETH {{ $eth * $nft->price }}</span>


    @if ($nft->forSale === 1)
        {{-- <form method="POST" action="{!! url('/nft/order/{{$buyerId}}') !!}" enctype='multipart/form-data'>
@csrf
<input type="hidden" name="id" value="{{ $nft->id }}">
<input type="hidden" name="price" value="{{ $eth * $nft->price }}">
<input type="hidden" name="seller" value="{{ $nft->owner_id }}">
<input type="hidden" name="buyer" value="{{ $user }}"> --}}

        <input id="buyNft" data-seller={{ $nft->creator_id }} data-user={{ $user }}
            data-eth={{ $eth * $nft->price }} data-token="{{ $nft->token_id }}" data-id="{{ $nft->id }}"
            type="submit" value="Buy">

        </form>
    @endif

    <script type="text/javascript">
        let buyNftBtns = document.querySelectorAll("#buyNft");
        buyNftBtns.forEach((buyNftBtn) => {
            buyNftBtn.addEventListener('click', async (e) => {
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

                let nftId = buyNftBtn.dataset.id;
                let tokenId = buyNftBtn.dataset.token;
                let userId = buyNftBtn.dataset.user;
                let sellerId = buyNftBtn.dataset.seller;

                let price = await contract.getPrice(tokenId);
                let priceToEth = ethers.utils.formatEther(price);

                let buyerId;
                const transaction = await contractWithSigner.buyNFT(ethers.BigNumber.from(tokenId), {
                    value: price.toString()
                });
                await transaction.wait().then(res => {
                    let buyerIdString = res['events'][2]['topics'][
                    2]; //returns string with tokenId as hexadecimal
                    buyerId = ethers.BigNumber.from(buyerIdString)
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
                form.action = `/nft/order/${nftId}/${buyerId}/${priceToEth}/${userId}/${sellerId}`;
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
