<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setName('Mathieu');
        $user->setEmail('mathieu.veys@gmail.com');
        $user->setPassword('mathieuveys');
        $user->setCreatedAt('24/08/2019');
        $manager->persist($user);

        $user = new User();
        $user->setName('Stéphanie');
        $user->setEmail('stephanie.percheron@gmail.com');
        $user->setPassword('stephaniepercheron');
        $user->setCreatedAt('25/08/2019');
        $manager->persist($user);

        $user = new User();
        $user->setName('Laurène');
        $user->setEmail('laurene.flamey@gmail.com');
        $user->setPassword('laureneflamey');
        $user->setCreatedAt('26/08/2019');
        $manager->persist($user);

        $manager->flush();
    }
}
