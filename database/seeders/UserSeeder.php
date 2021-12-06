<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
        $user1->email = "r0806290@student.thomasmore.be";
        $user1->password = Hash::make("Test12345");
        $user1->save();

        $user2 = new \App\Models\User();
        $user2->firstname = "Nick";
        $user2->lastname = "Koenig";
        $user2->email = "nick@atria.com";
        $user2->password = Hash::make("Test12345");
        $user2->save();

        $user3 = new \App\Models\User();
        $user3->firstname = "Nicolas";
        $user3->lastname = "van der Straten Ponthoz";
        $user3->email = "nicolas@atria.com";
        $user3->password = Hash::make("Test12345");
        $user3->save();

        $user4 = new \App\Models\User();
        $user4->firstname = "Jonathan";
        $user4->lastname = "Verhaegen";
        $user4->email = "jonathan_verhaegen@hotmail.com";
        $user4->password = Hash::make("Test12345");
        $user4->save();
    }
}
