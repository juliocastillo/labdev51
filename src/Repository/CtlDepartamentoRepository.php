<?php

namespace App\Repository;

use App\Entity\CtlDepartamento;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CtlDepartamento|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtlDepartamento|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtlDepartamento[]    findAll()
 * @method CtlDepartamento[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtlDepartamentoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtlDepartamento::class);
    }

    // /**
    //  * @return CtlDepartamento[] Returns an array of CtlDepartamento objects
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
    public function findOneBySomeField($value): ?CtlDepartamento
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
