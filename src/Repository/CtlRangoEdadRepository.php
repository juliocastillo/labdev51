<?php

namespace App\Repository;

use App\Entity\CtlRangoEdad;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CtlRangoEdad|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtlRangoEdad|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtlRangoEdad[]    findAll()
 * @method CtlRangoEdad[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtlRangoEdadRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtlRangoEdad::class);
    }

    // /**
    //  * @return CtlRangoEdad[] Returns an array of CtlRangoEdad objects
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
    public function findOneBySomeField($value): ?CtlRangoEdad
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
