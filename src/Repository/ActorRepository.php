<?php

namespace App\Repository;

use App\Entity\Actor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Actor>
 */
class ActorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Actor::class);
    }

    public function findByName(string $name)
    {
        $queryBuilder = $this->createQueryBuilder('a')
            ->where('a.name LIKE :name')
            ->setParameter('name', '%' . $name . '%')
            ->orderBy('a.name', 'ASC')
            ->getQuery();

        return $queryBuilder->getResult();
    }
}
