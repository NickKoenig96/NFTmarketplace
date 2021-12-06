@extends('layouts/app')
@section('title', 'Buy ')

@section('content')

<p>{{ $nft->title }}</p>
<p>{{ $nft->description }}</p>

@if($nft->forSale === 1)
<form method="POST" action="{{ url('/nft/order') }}" enctype='multipart/form-data'>
@csrf
<input type="hidden" name="id" value="{{ $nft->id }}">
<input type="hidden" name="price" value="{{ $nft->price }}">
<input type="hidden" name="seller" value="{{ $nft->owner_id }}">
<input type="hidden" name="buyer" value="{{ $user }}">

<input id="buyNft" data-hash="{{ $nft->item_hash }}" data-id="{{ $nft->id }}"  type="submit" value="Buy">

</form>
@endif

<script type="text/javascript">
    let buyNftBtns = document.querySelectorAll("#buyNft");
        buyNftBtns.forEach((buyNftBtn)=>{
            buyNftBtn.addEventListener('click', async(e)=>{
                e.preventDefault();
                const provider = new ethers.providers.Web3Provider(window.ethereum);
                const signer = provider.getSigner();
                const contractAddress = "0x76d463D9CA4CAE1Fd478d62e9914A6b6Cc2b604e";
                let Abi;
                await fetch("/abi/NFT.json").then((res) => {return res.json();}).then((data) => {Abi = data;});
                const contract = new ethers.Contract(contractAddress, Abi, provider);
                let contractWithSigner = contract.connect(signer);

                let id = buyNftBtn.dataset.id;
                // let tokenId = buyNftBtn.dataset.hash;

                let tokenId = "0xbf9881a644ad5fb16c8d408ce0d25fad1aef9e7f4c7752f33ae6bd4ee7688937";
                // console.log(tokenId);
                const itemId =  await contractWithSigner.buyNFT(tokenId);
                // send a post to form 
                // print de variable die de buynft mee gaf -> eventueel opslagen db?
            });
        })
</script>

@endsection