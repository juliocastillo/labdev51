<?php

namespace App\Repository;

use App\Entity\LabDetalleOrden;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LabDetalleOrden|null find($id, $lockMode = null, $lockVersion = null)
 * @method LabDetalleOrden|null findOneBy(array $criteria, array $orderBy = null)
 * @method LabDetalleOrden[]    findAll()
 * @method LabDetalleOrden[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LabDetalleOrdenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LabDetalleOrden::class);
    }

    // /**
    //  * @return LabDetalleOrden[] Returns an array of LabDetalleOrden objects
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
    public function findOneBySomeField($value): ?LabDetalleOrden
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
