<?php

namespace App\Tests;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;

class TokenTestCase extends ApiTestCase
{
    public string $token;

    protected function setUp() : void
    {
        $response = static::createClient()
            ->request('POST', 'http://127.0.0.1:8337/api/login', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'email' => 'admin@admin.com',
                    'password' => 'admin',
                ],
            ]);

        $response = json_decode($response->getContent());
        $this->token = $response['token'];
    }
}
