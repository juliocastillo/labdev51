<?php

namespace App\Repository;

use App\Entity\CtlPosibleResultado;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CtlPosibleResultado|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtlPosibleResultado|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtlPosibleResultado[]    findAll()
 * @method CtlPosibleResultado[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtlPosibleResultadoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtlPosibleResultado::class);
    }

    // /**
    //  * @return CtlPosibleResultado[] Returns an array of CtlPosibleResultado objects
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
    public function findOneBySomeField($value): ?CtlPosibleResultado
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
