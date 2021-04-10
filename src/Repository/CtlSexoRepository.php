<?php

namespace App\Repository;

use App\Entity\CtlSexo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CtlSexo|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtlSexo|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtlSexo[]    findAll()
 * @method CtlSexo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtlSexoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtlSexo::class);
    }

    // /**
    //  * @return CtlSexo[] Returns an array of CtlSexo objects
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
    public function findOneBySomeField($value): ?CtlSexo
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
