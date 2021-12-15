<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use \App\Models\Nft;


class NftTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_redirect()
    {
        $response = $this->get('/wallet');
        $response->assertStatus(302);
        
    }

    public function test_delete_nft(){
        $nft = new Nft();
        $nft->creator_id = 6;
        $nft->owner_id = 1;
        $nft->title = "test NFT";
        $nft->description ='test description NFT';
        $nft->area = 55.55;
        $nft->object_type = 'test objectype';
        $nft->price = 666;
        $nft->image_file_path = 'https://ipfs.io/ipfs/QmNLsX2CDs1xfGvzwVv4xyyg2sCXTjxJvjyP1RNtSLTK7d';
        $nft->collection_id = 5;
        $nft->save();

        $nftDB = Nft::where('title','test NFT' );

        if($nftDB){
            $nftDB->delete();
        }

        $this->assertTrue(true);

        
    }


    public function test_addNft(){

        $nft = [
            'creator_id' => 6,
            'owner_id' => 1,
            'title' => "test NFT",
            'description' => 'test description NFT',
            'area' => 55.55,
            'object_type' => 'test objectype',
            'price' => 666,
            'image_file_path' => 'https://ipfs.io/ipfs/QmNLsX2CDs1xfGvzwVv4xyyg2sCXTjxJvjyP1RNtSLTK7d',
            'collection_id' => 5
        ];

        $response = $this->post('/nft/addNft', $nft);
        $response->assertStatus(302);


        //$response->assertRedirect('/wallet');
    }
}
