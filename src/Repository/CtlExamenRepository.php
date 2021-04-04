<?php

namespace App\Repository;

use App\Entity\CtlExamen;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CtlExamen|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtlExamen|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtlExamen[]    findAll()
 * @method CtlExamen[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtlExamenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtlExamen::class);
    }

    // /**
    //  * @return CtlExamen[] Returns an array of CtlExamen objects
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
    public function findOneBySomeField($value): ?CtlExamen
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
