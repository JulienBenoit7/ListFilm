<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Category>
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    public function findByName(string $name)
    {
        $queryBuilder = $this->createQueryBuilder('c')
            ->where('c.name LIKE :name')
            ->setParameter('name', '%' . $name . '%')
            ->getQuery();

        return $queryBuilder->getResult();
    }
}
