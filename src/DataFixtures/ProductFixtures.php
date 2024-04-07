<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager) : void
    {
        $count = $manager->getRepository(Product::class)->count();

        if ($count > 0) {
            return;
        }

        $productPayload = [
            [
                'name' => 'Iphone',
                'price' => 100,
            ],
            [
                'name' => 'Наушники',
                'price' => 20,
            ],
            [
                'name' => 'Чехол',
                'price' => 10,
            ],
        ];

        foreach ($productPayload as $product) {
            $model = new Product();
            $model->setName($product['name']);
            $model->setPrice($product['price']);
            $manager->persist($model);
        }
        $manager->flush();
    }
}
