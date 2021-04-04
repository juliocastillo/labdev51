<?php

namespace App\Repository;

use App\Entity\MntEmpleado;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MntEmpleado|null find($id, $lockMode = null, $lockVersion = null)
 * @method MntEmpleado|null findOneBy(array $criteria, array $orderBy = null)
 * @method MntEmpleado[]    findAll()
 * @method MntEmpleado[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MntEmpleadoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MntEmpleado::class);
    }

    // /**
    //  * @return MntEmpleado[] Returns an array of MntEmpleado objects
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
    public function findOneBySomeField($value): ?MntEmpleado
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
