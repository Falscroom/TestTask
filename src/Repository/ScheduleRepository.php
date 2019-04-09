<?php

namespace App\Repository;

use App\Entity\Schedule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\NonUniqueResultException;

/**
 * @method Schedule|null find($id, $lockMode = null, $lockVersion = null)
 * @method Schedule|null findOneBy(array $criteria, array $orderBy = null)
 * @method Schedule[]    findAll()
 * @method Schedule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ScheduleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Schedule::class);
    }
    public function getDays() {
        $em = $this->getEntityManager();
        return $em->createQuery('SELECT p FROM App\Entity\Schedule p')->setMaxResults(7)->getResult();
    }
    public function getDayByNumDay($num): ? Schedule
    {
        try {
            return $this->createQueryBuilder('s')
                ->andWhere('s.numDay = :num')
                ->setParameter('num', $num)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            return null;
        }


        /*createQuery('SELECT p FROM App\Entity\Schedule p WHERE p.numDay = :num')->setParameter('num',$num )->getResult();*/
    }
    public function destroyEverything() {
        return $this->createQueryBuilder('s')
            ->delete()
            ->getQuery()
            ->getResult();
    }
}
