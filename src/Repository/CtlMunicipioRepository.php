<?php

namespace App\Repository;

use App\Entity\CtlMunicipio;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CtlMunicipio|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtlMunicipio|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtlMunicipio[]    findAll()
 * @method CtlMunicipio[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtlMunicipioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtlMunicipio::class);
    }

    // /**
    //  * @return CtlMunicipio[] Returns an array of CtlMunicipio objects
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
    public function findOneBySomeField($value): ?CtlMunicipio
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
