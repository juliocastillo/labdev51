<?php

namespace App\Repository;

use App\Entity\CtlMicroorganismo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CtlMicroorganismo|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtlMicroorganismo|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtlMicroorganismo[]    findAll()
 * @method CtlMicroorganismo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtlMicroorganismoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtlMicroorganismo::class);
    }

    // /**
    //  * @return CtlMicroorganismo[] Returns an array of CtlMicroorganismo objects
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
    public function findOneBySomeField($value): ?CtlMicroorganismo
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
