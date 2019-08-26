<?php

namespace App\DataFixtures;

use App\Entity\Task;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TaskFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $task = new Task();
        $task->setName('Courses');
        $task->setDescription('- pain - lait - beurre');
        $task->setStatus('to do');
        $manager->persist($task);

        $task = new Task();
        $task->setName('Rendez-vous');
        $task->setDescription('Médecin à 17h30');
        $task->setStatus('in progress');
        $manager->persist($task);

        $task = new Task();
        $task->setName('Sport');
        $task->setDescription('Running 5km');
        $task->setStatus('done');
        $manager->persist($task);

        $manager->flush();
    }
}
