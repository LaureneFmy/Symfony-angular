<?php

namespace App\DataFixtures;

use App\Entity\Task;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class TaskFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @param ObjectManager $manager
     *
     * @return void
     */

    public function load(ObjectManager $manager) : void
    {
        $task = new Task();
        $task->setName('Courses');
        $task->setDescription('- pain - lait - beurre');
        $task->setStatus('to do');
        $task->setUserId($manager->merge($this->getReference('user_1')));
        $manager->persist($task);

        $task = new Task();
        $task->setName('Rendez-vous');
        $task->setDescription('Médecin à 17h30');
        $task->setStatus('in progress');
        $task->setUserId($manager->merge($this->getReference('user_2')));
        $manager->persist($task);

        $task = new Task();
        $task->setName('Sport');
        $task->setDescription('Running 5km');
        $task->setStatus('done');
        $task->setUserId($manager->merge($this->getReference('user_3')));
        $manager->persist($task);

        $manager->flush();


    }
    /**
     * @return array
     */
    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }
}
