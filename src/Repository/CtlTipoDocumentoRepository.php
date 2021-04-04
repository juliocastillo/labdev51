<?php

namespace App\Repository;

use App\Entity\CtlTipoDocumento;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CtlTipoDocumento|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtlTipoDocumento|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtlTipoDocumento[]    findAll()
 * @method CtlTipoDocumento[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtlTipoDocumentoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtlTipoDocumento::class);
    }

    // /**
    //  * @return CtlTipoDocumento[] Returns an array of CtlTipoDocumento objects
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
    public function findOneBySomeField($value): ?CtlTipoDocumento
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
