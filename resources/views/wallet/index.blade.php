@extends('layouts/app')

@section('title', 'Wallet')

@section('content')

    <x-header firstname="{{ 'Jonathan' }}" />

    <div class="walletTitle">
        <h1>My NFT's (at the moment all nft's)</h1>
        <div class="card--btns">
            <a href="nft/addNft"> <img src="{{ url('assets/icons/icon_plus.png') }}" alt="bin">
            </a>
        </div>
    </div>




    <div class="walletNFT">
        @foreach ($nfts as $nft)

            <div class="cards card card--NFT">
                <img class="card--NftImg" src="{{ asset('storage/images/' . $nft->image_file_path) }}" alt="">
                <p class="card__title card--nftTitle">{{ $nft->title }}</p>
                <div class="card--btns">
                    <a class="btn btn--view" href="#">View</a>
                    <a class="btn btn--sell" href="#">Sell</a>
                </div>
                <div class="card--btns">
                    <a href="delete/nft/{{ $nft->id }}"> <img class="card--icon"
                            src="{{ url('assets/icons/icon_bin.png') }}" alt="bin">
                    </a>
                    <a href="edit/nft/{{ $nft->id }}"><img class="card--icon"
                            src="{{ url('assets/icons/icon_edit.png') }}" alt="edit"></a>
                </div>
            </div>


        @endforeach
    </div>





    <div class="walletTitle">
        <h1>My collections (at the moment all collections)</h1>
        <div class="card--btns">
            <a href="collection/addCollection"> <img src="{{ url('assets/icons/icon_plus.png') }}" alt="bin">
            </a>
        </div>
    </div>

    @foreach ($collections as $collection)

        <p>add code of person that makes collection page</p>

    @endforeach



@endsection
