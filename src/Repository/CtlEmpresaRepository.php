<?php

namespace App\Repository;

use App\Entity\CtlEmpresa;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CtlEmpresa|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtlEmpresa|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtlEmpresa[]    findAll()
 * @method CtlEmpresa[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtlEmpresaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtlEmpresa::class);
    }

    // /**
    //  * @return CtlEmpresa[] Returns an array of CtlEmpresa objects
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
    public function findOneBySomeField($value): ?CtlEmpresa
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
