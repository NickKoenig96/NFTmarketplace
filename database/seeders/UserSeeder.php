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
        $user1->name = "Stephanie Lambrights";
        $user1->email = "stephanie@test.com";
        $user1->password = "changethisplease";
        
        $user1->save();

        $user2 = new \App\Models\User();
        $user2->name = "Nick Koenig";
        $user2->email = "nick@test.com";
        $user2->password = "changethisplease";
        
        $user2->save();

        $user3 = new \App\Models\User();
        $user3->name = "Nicolas van der Straten Ponthoz";
        $user3->email = "nicolas@test.com";
        $user3->password = "changethisplease";
        
        $user3->save();

        $user4 = new \App\Models\User();
        $user4->name = "Jonathan Verhaegen";
        $user4->email = "jonathan@test.com";
        $user4->password = "changethisplease";
        
        $user4->save();
    }
}
