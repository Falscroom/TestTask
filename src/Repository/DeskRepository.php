<?php

namespace App\Repository;

use App\Entity\Desk;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Desk|null find($id, $lockMode = null, $lockVersion = null)
 * @method Desk|null findOneBy(array $criteria, array $orderBy = null)
 * @method Desk[]    findAll()
 * @method Desk[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DeskRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Desk::class);
    }
}
