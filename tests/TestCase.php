<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Passport\ClientRepository;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setUp() : void
    {
        parent::setUp();
        $this->setUpPassport();
    }

    private function setUpPassport()
    {
        $clientRepository = new ClientRepository();
        
        $client = $clientRepository->createPersonalAccessClient(
            null,
            'Test Personal Access Client',
            config('app.url')
        );

        \DB::table('oauth_personal_access_clients')->insert([
            'client_id' => $client->id,
            'created_at' => new \DateTime(),
            'updated_at' => new \DateTime(),
        ]);
    }
}
