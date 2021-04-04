<?php

namespace App\Repository;

use App\Entity\CtlEstadoExamen;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CtlEstadoExamen|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtlEstadoExamen|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtlEstadoExamen[]    findAll()
 * @method CtlEstadoExamen[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtlEstadoExamenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtlEstadoExamen::class);
    }

    // /**
    //  * @return CtlEstadoExamen[] Returns an array of CtlEstadoExamen objects
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
    public function findOneBySomeField($value): ?CtlEstadoExamen
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
