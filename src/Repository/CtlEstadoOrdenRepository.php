<?php

namespace App\Repository;

use App\Entity\CtlEstadoOrden;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CtlEstadoOrden|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtlEstadoOrden|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtlEstadoOrden[]    findAll()
 * @method CtlEstadoOrden[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtlEstadoOrdenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtlEstadoOrden::class);
    }

    // /**
    //  * @return CtlEstadoOrden[] Returns an array of CtlEstadoOrden objects
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
    public function findOneBySomeField($value): ?CtlEstadoOrden
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
