<?php

namespace App\Repository;

use App\Entity\CtlFormaPago;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CtlFormaPago|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtlFormaPago|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtlFormaPago[]    findAll()
 * @method CtlFormaPago[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtlFormaPagoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtlFormaPago::class);
    }

    // /**
    //  * @return CtlFormaPago[] Returns an array of CtlFormaPago objects
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
    public function findOneBySomeField($value): ?CtlFormaPago
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
