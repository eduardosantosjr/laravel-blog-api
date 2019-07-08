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
        
        dump($user);
        $this->assertTrue(true);
        dump('isadump');

        $this->artisan('migrate:rollback');
    }

    //public function testLogout()

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
