<?php

namespace Tests\Unit;

use Tests\TestCase;
use \App\Models\Nft;
use \App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

class NftTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_create_nft_in_database()
    {
        $newNft = new Nft;
        $newNft->title = "testNft";
        $newNft->description = "Lorem Ipsum";
        $newNft->image_file_path = "https://ipfs.io/ipfs/QmW4ujhxvW83pbb53aRSVZqM6gtZikGWT9u7osUzwotmik";
        $newNft->creator_id = 1;
        $newNft->owner_id = 1;
        $newNft->price = 1;
        $newNft->token_id = 0;
        $newNft->minted = 0;
        $newNft->forSale = 1;
        $newNft->collection_id = 1;
        $newNft->area = 1;
        $newNft->object_type = "test";
        $newNft->save();

        $this->assertTrue(true);
    }

    public function test_edit_nft(){
        
        $nft = Nft::where('title', 'testNft')->get();

        $edit = [
            'id' => 1,
            'nftTitle' => 'testNftchange',
            'nftArea' => 1,
            'nftObjectType' => 'test2',
            'nftPrice' => 2,
            'nftDescription' => "lorem ipsum",
            'collectionsId' => 2
         ];

         $response = $this->post('/nft/editNft', $edit);
         $response->assertRedirect('/wallet');

    }

    public function test_delete_nft(){
        $nft = NFt::where('title', 'testNftchange' );
        $nftId = $nft->id;

        $response= $this->post('/delete/nft/1');
        $response->assertRedirect('/wallet');
    }

    
}
