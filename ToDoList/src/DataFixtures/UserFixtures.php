<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user1 = new User();
        $user1->setName('Mathieu');
        $user1->setEmail('mathieu.veys@gmail.com');
        $user1->setPassword('mathieuveys');
        $manager->persist($user1);

        $user2 = new User();
        $user2->setName('Stéphanie');
        $user2->setEmail('stephanie.percheron@gmail.com');
        $user2->setPassword('stephaniepercheron');
        $manager->persist($user2);

        $user3 = new User();
        $user3->setName('Laurène');
        $user3->setEmail('laurene.flamey@gmail.com');
        $user3->setPassword('laureneflamey');
        $manager->persist($user3);

        $manager->flush();

        $this->addReference('user_1', $user1);
        $this->addReference('user_2', $user2);
        $this->addReference('user_3', $user3);
    }
}
