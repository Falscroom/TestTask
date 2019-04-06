<?php

namespace App\Repository;

use App\Entity\ExceptionDay;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ExceptionDay|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExceptionDay|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExceptionDay[]    findAll()
 * @method ExceptionDay[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExceptionDayRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ExceptionDay::class);
    }

    // /**
    //  * @return ExceptionDay[] Returns an array of ExceptionDay objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ExceptionDay
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
