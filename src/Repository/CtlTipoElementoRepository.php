<?php

namespace App\Repository;

use App\Entity\CtlTipoElemento;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CtlTipoElemento|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtlTipoElemento|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtlTipoElemento[]    findAll()
 * @method CtlTipoElemento[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtlTipoElementoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtlTipoElemento::class);
    }

    // /**
    //  * @return CtlTipoElemento[] Returns an array of CtlTipoElemento objects
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
    public function findOneBySomeField($value): ?CtlTipoElemento
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
