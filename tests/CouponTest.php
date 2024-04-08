<?php

namespace App\Tests;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;

class CouponTest extends ApiTestCase
{

    public function testSomething() : void
    {
        $response = static::createClient()->request('POST', '/api/coupon-validate');

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains(['@id' => '/']);
    }
}
