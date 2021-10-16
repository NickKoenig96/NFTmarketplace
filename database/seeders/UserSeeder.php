<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user1 = new \App\Models\User();
        $user1->firstname = "Stephanie";
        $user1->lastname = "Lambrights";
        $user1->email = "stephanie@test.com";
        $user1->password = "changethisplease";
        $user1->street = "Diablo Blvd";
        $user1->housenumber = "666";
        $user1->city = "Springfield";
        $user1->postal = "NS2945";
        $user1->country = "United States";
        $user1->phone = "0485027580";
        $user1->bio = "My world changed the moment I stepped foot on the moon. The serenity that I had experienced was literally out of this world. I hope I can share my emotions with my NFT-collections";
        
        $user1->save();

        $user2 = new \App\Models\User();
        $user2->firstname = "Nick";
        $user2->lastname = "Koenig";
        $user2->email = "nick@test.com";
        $user2->password = "changethisplease";
        $user2->street = "Diablo Blvd";
        $user2->housenumber = "666";
        $user2->city = "Springfield";
        $user2->postal = "NS2945";
        $user2->country = "United States";
        $user2->phone = "0485027580";
        $user2->bio = "My world changed the moment I stepped foot on the moon. The serenity that I had experienced was literally out of this world. I hope I can share my emotions with my NFT-collections";
        
        $user2->save();

        $user3 = new \App\Models\User();
        $user3->firstname = "Nicolas";
        $user3->lastname = "van der Straten Ponthoz";
        $user3->email = "nicolas@test.com";
        $user3->password = "changethisplease";
        $user3->street = "Diablo Blvd";
        $user3->housenumber = "666";
        $user3->city = "Springfield";
        $user3->postal = "NS2945";
        $user3->country = "United States";
        $user3->phone = "0485027580";
        $user3->bio = "My world changed the moment I stepped foot on the moon. The serenity that I had experienced was literally out of this world. I hope I can share my emotions with my NFT-collections";
        
        $user3->save();

        $user4 = new \App\Models\User();
        $user4->firstname = "Jonathan";
        $user4->lastname = "Verhaegen";
        $user4->email = "jonathan@test.com";
        $user4->password = "changethisplease";
        $user4->street = "Diablo Blvd";
        $user4->housenumber = "666";
        $user4->city = "Springfield";
        $user4->postal = "NS2945";
        $user4->country = "United States";
        $user4->phone = "0485027580";
        $user4->bio = "My world changed the moment I stepped foot on the moon. The serenity that I had experienced was literally out of this world. I hope I can share my emotions with my NFT-collections";
        
        $user4->save();
    }
}
