<?php

namespace App\Repository;

use App\Entity\LabResultados;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LabResultados|null find($id, $lockMode = null, $lockVersion = null)
 * @method LabResultados|null findOneBy(array $criteria, array $orderBy = null)
 * @method LabResultados[]    findAll()
 * @method LabResultados[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LabResultadosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LabResultados::class);
    }

    // /**
    //  * @return LabResultados[] Returns an array of LabResultados objects
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
    public function findOneBySomeField($value): ?LabResultados
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
