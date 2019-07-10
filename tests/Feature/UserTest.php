<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    private $name = 'Test User';
    private $email = 'test@mail.com';
    private $password = '123456';
    
    public function setUp() : void
    {
        parent::setUp();
        $this->setUpPassport();
    }

    public function testRegister()
    {
        $response = $this->registerUser();

        $response->assertStatus(200);
    }

    public function testLogin()
    {
        $this->registerUser();
        
        $response = $this->post(
            route('auth.user.login'),
            [
                'email' => $this->email,
                'password' => $this->password,
            ]
        );

        $response->assertStatus(200);
    }

    public function testDetails()
    {
        $user = $this->registerUser()->decodeResponseJson();

        $response = $this->get(
            route('auth.user.details'),
            [
                'Authorization' => 'Bearer '. $user['data']['token']
            ]
        );
        
        $response->assertStatus(200);
    }

    public function testLogout()
    {
        $user = $this->registerUser()->decodeResponseJson();

        $response = $this->get(
            route('auth.user.logout'),
            [
                'Authorization' => 'Bearer '. $user['data']['token']
            ]
        );
        
        $response->assertStatus(200);
    }

    private function registerUser()
    {
        return $this->post(
            route('auth.user.register'),
            [
                'name' => $this->name,
                'email' => $this->email,
                'password' => $this->password,
            ]
        );
    }
}
