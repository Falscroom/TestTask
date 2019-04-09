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
}
