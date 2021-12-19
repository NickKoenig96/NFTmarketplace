@extends('layouts/app')

@section('title', 'Buy')

@section('content')

    <x-header firstname="{{ $user->firstname }}" />

    <section>
        <h1>Buy NFT</h1>

        <div class="cardgallery">
            <div class="card card--3col flex--spbet">
                <img class="card__image card__image--large" src="{{ $nft->image_file_path }}" alt="avatar">
                <div class="marginb-24">
                    <div class="flex--spbet">
                        <p class="card__title" style="margin-bottom: 0px;">{{ $nft->title }}</p>
                    </div>
                    <div class="flex--spbet">
                        <span class="card__price">€ {{ $nft->price }}</span>
                    </div>
                    <div class="flex--spbet">
                        <span data-token="{{ $nft->token_id }}" class="card__price--eth">ETH {{ $eth * $nft->price }}</span>
                    </div>
                </div>
                <div class="flex--spbet">
                    @if ($nft->forSale === 1)
                        <button class="btn btn--blue btn--155" id="buyNft" data-seller={{ $nft->creator_id }} data-user={{ $user->id }}
                            data-eth={{ $eth * $nft->price }} data-token="{{ $nft->token_id }}" data-id="{{ $nft->id }}"
                            type="submit">Buy
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </section>
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
@endsection
