<?php

namespace App\Repository;

use App\Entity\Task;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;

/**
 * @method Task|null find($id, $lockMode = null, $lockVersion = null)
 * @method Task|null findOneBy(array $criteria, array $orderBy = null)
 * @method Task[]    findAll()
 * @method Task[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaskRepository extends EntityRepository
{

    /**
    * @param int $userId
    * @return Task[] Returns an array of Tasks objects
    */
    public function findTaskByUser(int $userId)
    {
        return $this->createQueryBuilder('t')
            ->Where('t.user = :userId')
            ->setParameter('userId', $userId)
            ->orderBy('t.date', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

}
