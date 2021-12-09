<?php

namespace Tests\Unit;


use Tests\TestCase;
use \App\Models\User;

class userTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_login_form()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        
    }

    public function test_user_duplication(){
        $user1 = new User;
        $user1->firstname = 'john';
        $user1->lastname = 'doe';
        $user1->email = 'john@test.com';

        $user2 = new User;
        $user2->firstname = 'pieter';
        $user2->lastname = 'post';
        $user2->email = "pieter@test.com";

        $this->assertTrue($user1->email != $user2->email);
    }

    public function test_delete_user(){
        $user = User::factory()->count(1)->make();
        $user = User::first();
        if($user){
            $user->delete();
        }

        $this->assertTrue(true);
    }
}
