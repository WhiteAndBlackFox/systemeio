<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $userPasswordHasher)
    {
    }


    public function load(ObjectManager $manager) : void
    {
        $count = $manager->getRepository(User::class)->count();
        if ($count > 0) {
            return;
        }

        $model = new User();
        $model->setEmail('admin@admin.com');
        $model->setRoles(["ROLE_ADMIN"]);
        $model->setPassword($this->userPasswordHasher->hashPassword($model, "admin"));
        $manager->persist($model);
        $manager->flush();
    }
}
