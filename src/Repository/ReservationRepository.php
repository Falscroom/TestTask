<?php

namespace App\Repository;

use App\Entity\Reservation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\NonUniqueResultException;

/**
 * @method Reservation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reservation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reservation[]    findAll()
 * @method Reservation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Reservation::class);
    }

    public function ifReserved($start,$end,$date,$desk) //TODO  createQueryBuilder
    {
            $em = $this->getEntityManager();
            return $em->createQuery('SELECT r FROM App\Entity\Reservation r 
                WHERE :start > r.time AND :start < r.endTime AND :date = r.date AND r.Desk = :desk 
                OR :end > r.time AND :end < r.endTime AND :date = r.date AND r.Desk = :desk
                OR :start = r.time AND :end = r.endTime AND :date = r.date AND r.Desk = :desk')
                ->setParameter('start', $start)
                ->setParameter('end',$end)
                ->setParameter('date',$date)
                ->setParameter('desk',$desk)
                ->getArrayResult();

    }
    public function findOneById($id): ?Reservation
    {
        try {
            return $this->createQueryBuilder('r')
                ->andWhere('r.id = :val')
                ->setParameter('val', $id)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }
}
