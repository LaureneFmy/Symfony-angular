<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{

    /**
     * @param int $id
     * @return User[]
     */
    public function findUser($id)
    {
        return $this->createQueryBuilder('u')
            ->Where('u.id = :id')
            ->setParameter('userId', $id)
            ->getQuery()
            ->getResult()
            ;
    }
}
