<?php

namespace App\DataFixtures;

use App\Entity\Coupon;
use App\Entity\Enum\CouponType;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CouponFixtures extends Fixture
{
    public function load(ObjectManager $manager) : void
    {
        $count = $manager->getRepository(Coupon::class)->count();

        if ($count > 0) {
            return;
        }

        $couponPayload = [
            [
                'code' => 'P10',
                'discount' => 10,
                'type' => CouponType::TYPE_PERCENT,
                'valid_from' => new \DateTimeImmutable('2024-04-01'),
                'valid_to' => new \DateTimeImmutable('2024-04-30'),
            ],
            [
                'code' => 'P100',
                'discount' => 100,
                'type' => CouponType::TYPE_FIXED,
                'valid_from' => new \DateTimeImmutable('2024-04-01'),
                'valid_to' => new \DateTimeImmutable('2024-04-30'),
            ],
            [
                'code' => 'P20',
                'discount' => 20,
                'type' => CouponType::TYPE_PERCENT,
                'valid_from' => new \DateTimeImmutable('2024-01-01'),
                'valid_to' => new \DateTimeImmutable('2024-01-30'),
            ]
        ];

        foreach ($couponPayload as $coupon) {
            $model = new Coupon();
            $model->setCode($coupon['code']);
            $model->setDiscount($coupon['discount']);
            $model->setType($coupon['type']);
            $model->setValidFrom($coupon['valid_from']);
            $model->setValidTo($coupon['valid_to']);
            $manager->persist($model);
        }

        $manager->flush();
    }
}
