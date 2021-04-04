<?php

namespace App\Repository;

use App\Entity\MntElementos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MntElementos|null find($id, $lockMode = null, $lockVersion = null)
 * @method MntElementos|null findOneBy(array $criteria, array $orderBy = null)
 * @method MntElementos[]    findAll()
 * @method MntElementos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MntElementosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MntElementos::class);
    }

    // /**
    //  * @return MntElementos[] Returns an array of MntElementos objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MntElementos
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
