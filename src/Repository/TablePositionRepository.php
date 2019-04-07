<?php

namespace App\Repository;

use App\Entity\TablePosition;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TablePosition|null find($id, $lockMode = null, $lockVersion = null)
 * @method TablePosition|null findOneBy(array $criteria, array $orderBy = null)
 * @method TablePosition[]    findAll()
 * @method TablePosition[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TablePositionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TablePosition::class);
    }

    // /**
    //  * @return TablePosition[] Returns an array of TablePosition objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TablePosition
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
