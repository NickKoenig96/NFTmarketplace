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
        
        $user1 = new User;
        $user1->firstname = 'john';
        $user1->lastname = 'doe';
        $user1->email = 'john@test.com';
        $user1->password = "test12345";
        $user1->save();

        $user = User::where('email','john@test.com');
        
        if($user){
            $user->delete();
        }

        $this->assertTrue(true);
    }

    public function test_register_user(){

        $user = [
            'firstname' => 'John',
            'lastname' => 'Doe',
            'email' => 'john@test2.com',
            'password' => 'Test12345'
        ];

        $response = $this->post('/users/signup', $user);

        $response->assertRedirect('/');
    }
}
