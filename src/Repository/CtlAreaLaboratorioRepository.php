<?php

namespace App\Repository;

use App\Entity\CtlAreaLaboratorio;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CtlAreaLaboratorio|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtlAreaLaboratorio|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtlAreaLaboratorio[]    findAll()
 * @method CtlAreaLaboratorio[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtlAreaLaboratorioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtlAreaLaboratorio::class);
    }

    // /**
    //  * @return CtlAreaLaboratorio[] Returns an array of CtlAreaLaboratorio objects
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
    public function findOneBySomeField($value): ?CtlAreaLaboratorio
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
