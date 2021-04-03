<?php

namespace App\Repository;

use App\Entity\LabOrden;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LabOrden|null find($id, $lockMode = null, $lockVersion = null)
 * @method LabOrden|null findOneBy(array $criteria, array $orderBy = null)
 * @method LabOrden[]    findAll()
 * @method LabOrden[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LabOrdenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LabOrden::class);
    }

    // /**
    //  * @return LabOrden[] Returns an array of LabOrden objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LabOrden
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
