<?php

namespace App\Tests;

class CouponTest extends TokenTestCase
{
    public function testCouponIsValidate() : void
    {
        static::createClient()
            ->request('POST', '/api/coupon-validate', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Authorization' => $this->token,
                ],
                'json' => [
                    'coupon' => 'P10',
                ],
            ]);

        $this->assertResponseIsSuccessful();
    }

    public function testCouponIsNotValidate() : void
    {
        static::createClient()
            ->request('POST', '/api/coupon-validate', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Authorization' => $this->token,
                ],
                'json' => [
                    'coupon' => 'P20',
                ],
            ]);

        $this->assertResponseStatusCodeSame(404);
    }
}
