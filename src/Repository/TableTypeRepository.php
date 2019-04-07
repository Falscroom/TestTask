<?php

namespace App\Repository;

use App\Entity\TableType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TableType|null find($id, $lockMode = null, $lockVersion = null)
 * @method TableType|null findOneBy(array $criteria, array $orderBy = null)
 * @method TableType[]    findAll()
 * @method TableType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TableTypeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TableType::class);
    }

    // /**
    //  * @return TableType[] Returns an array of TableType objects
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
    public function findOneBySomeField($value): ?TableType
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
