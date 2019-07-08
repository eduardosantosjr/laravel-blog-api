<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function testRegister()
    {
        $response = $this->post(
            route('auth.user.register'),
            [
                'name' => 'Test User',
                'email' => 'test@mail.com',
                'password' => '123456'
            ]
        );

        $response->assertStatus(200);
    }

    /**
     * @depends testRegister
     */
    //public function testLogin()

    /**
     * @depends testLogin
     */
    
    //public function testDetails()

    /**
     * @depends testDetails
     */
    //public function testLogout()
}
