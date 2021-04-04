<?php

namespace App\Repository;

use App\Entity\CtlCargoEmpleado;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CtlCargoEmpleado|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtlCargoEmpleado|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtlCargoEmpleado[]    findAll()
 * @method CtlCargoEmpleado[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtlCargoEmpleadoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtlCargoEmpleado::class);
    }

    // /**
    //  * @return CtlCargoEmpleado[] Returns an array of CtlCargoEmpleado objects
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
    public function findOneBySomeField($value): ?CtlCargoEmpleado
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
