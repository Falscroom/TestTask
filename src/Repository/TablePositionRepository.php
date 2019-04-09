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
}
