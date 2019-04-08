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

    public function getBetween($date_start,$date_end) {
        $em = $this->getEntityManager();
        return $em->createQuery('SELECT e FROM App\Entity\ExceptionDay e WHERE e.date BETWEEN :date_start AND :date_end')
            ->setParameter('date_start', $date_start)->setParameter(':date_end', $date_end)->getResult();
    }
    public function datesAsKeys($dates) {
        $result = [];
        foreach ($dates as $key => $day) {
            $result[$day->getDate()->format('Y-m-d')] = $day;
        }
        return $result;
    }

    public function findOneByDate($date): ?ExceptionDay
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.date = :val')
            ->setParameter('val', $date)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
