<?php

namespace App\Repository;

use App\Entity\ExceptionDay;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\NonUniqueResultException;
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

    public function getBetween($date_start,$date_end)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.date BETWEEN :date AND :date_end')
            ->setParameter('date', $date_start )
            ->setParameter('date_end', $date_end )
            ->getQuery()
            ->getResult();
    }
    public function datesAsKeys($dates)
    {
        $result = [];
        foreach ($dates as $key => $day) {
            $result[$day->getDate()->format('Y-m-d')] = $day;
        }
        return $result;
    }

    public function findOneByDate($date): ?ExceptionDay
    {
        try {
            return $this->createQueryBuilder('e')
                ->andWhere('e.date = :val')
                ->setParameter('val', $date)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }
}
