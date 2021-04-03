<?php

namespace App\Repository;

use App\Entity\CnfLaboratorio;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CnfLaboratorio|null find($id, $lockMode = null, $lockVersion = null)
 * @method CnfLaboratorio|null findOneBy(array $criteria, array $orderBy = null)
 * @method CnfLaboratorio[]    findAll()
 * @method CnfLaboratorio[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CnfLaboratorioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CnfLaboratorio::class);
    }

    // /**
    //  * @return CnfLaboratorio[] Returns an array of CnfLaboratorio objects
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
    public function findOneBySomeField($value): ?CnfLaboratorio
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
