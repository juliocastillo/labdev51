<?php

namespace App\Repository;

use App\Entity\CtlDescuento;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CtlDescuento|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtlDescuento|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtlDescuento[]    findAll()
 * @method CtlDescuento[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtlDescuentoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtlDescuento::class);
    }

    // /**
    //  * @return CtlDescuento[] Returns an array of CtlDescuento objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CtlDescuento
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
