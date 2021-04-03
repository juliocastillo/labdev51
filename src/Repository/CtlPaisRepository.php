<?php

namespace App\Repository;

use App\Entity\CtlPais;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CtlPais|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtlPais|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtlPais[]    findAll()
 * @method CtlPais[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtlPaisRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtlPais::class);
    }

    // /**
    //  * @return CtlPais[] Returns an array of CtlPais objects
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
    public function findOneBySomeField($value): ?CtlPais
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
