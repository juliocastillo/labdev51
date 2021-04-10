<?php

namespace App\Repository;

use App\Entity\CtlTemplate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CtlTemplate|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtlTemplate|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtlTemplate[]    findAll()
 * @method CtlTemplate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtlTemplateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtlTemplate::class);
    }

    // /**
    //  * @return CtlTemplate[] Returns an array of CtlTemplate objects
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
    public function findOneBySomeField($value): ?CtlTemplate
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
