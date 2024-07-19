<?php

namespace App\Repository;

use App\Entity\Series;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Series>
 */
class SeriesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Series::class);
    }

    public function findLikeName(string $name)
    {
        $queryBuilder = $this->createQueryBuilder('f')
            ->where('f.title LIKE :name')
            ->setParameter('name', '%' . $name . '%')
            ->orderBy('f.title', 'ASC')
            ->getQuery();

        return $queryBuilder->getResult();
    }

    /**
     * @return Series[] Returns an array of Films objects
     */
    public function findByActor($actor): array
    {
        return $this->createQueryBuilder('s')
            ->innerJoin('s.actors', 'a')
            ->andWhere('a.id = :actorId')
            ->setParameter('actorId', $actor->getId())
            ->orderBy('s.id', 'DESC')
            ->getQuery()
            ->getResult();
    }
}
