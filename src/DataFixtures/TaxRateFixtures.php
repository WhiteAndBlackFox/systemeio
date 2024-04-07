<?php

namespace App\DataFixtures;

use App\Entity\TaxRate;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class TaxRateFixtures extends Fixture
{
    public function load(ObjectManager $manager) : void
    {
        $count = $manager->getRepository(TaxRate::class)->count();

        if ($count > 0) {
            return;
        }

        $taxRatePayload = [
            [
                'name' => 'Германия',
                'rate' => 19,
                'is_active' => true,
                'country_code' => 'DE',
            ],
            [
                'name' => 'Италия',
                'rate' => 22,
                'is_active' => false,
                'country_code' => 'IT',
            ],
            [
                'name' => 'Франция',
                'rate' => 20,
                'is_active' => true,
                'country_code' => 'FR',
            ],
            [
                'name' => 'Греция',
                'rate' => 24,
                'is_active' => true,
                'country_code' => 'GR',
            ],
        ];

        foreach ($taxRatePayload as $taxRate) {
            $model = new TaxRate();
            $model->setName($taxRate['name']);
            $model->setRate($taxRate['rate']);
            $model->setActive($taxRate['is_active']);
            $model->setCountryCode($taxRate['country_code']);
            $manager->persist($model);
        }
        $manager->flush();
    }
}
