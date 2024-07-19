<?php

namespace App\Repository;

use App\Entity\Films;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Films>
 */
class FilmsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Films::class);
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
     * @return Films[] Returns an array of Films objects
     */
    public function findByActor($actor): array
    {
        return $this->createQueryBuilder('f')
            ->innerJoin('f.actors', 'a')
            ->andWhere('a.id = :actorId')
            ->setParameter('actorId', $actor->getId())
            ->orderBy('f.id', 'DESC')
            ->getQuery()
            ->getResult();
    }

    //    /**
    //     * @return Films[] Returns an array of Films objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('f')
    //            ->andWhere('f.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('f.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Films
    //    {
    //        return $this->createQueryBuilder('f')
    //            ->andWhere('f.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
