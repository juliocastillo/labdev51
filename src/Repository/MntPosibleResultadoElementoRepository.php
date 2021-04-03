<?php

namespace App\Repository;

use App\Entity\MntPosibleResultadoElemento;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MntPosibleResultadoElemento|null find($id, $lockMode = null, $lockVersion = null)
 * @method MntPosibleResultadoElemento|null findOneBy(array $criteria, array $orderBy = null)
 * @method MntPosibleResultadoElemento[]    findAll()
 * @method MntPosibleResultadoElemento[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MntPosibleResultadoElementoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MntPosibleResultadoElemento::class);
    }

    // /**
    //  * @return MntPosibleResultadoElemento[] Returns an array of MntPosibleResultadoElemento objects
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
    public function findOneBySomeField($value): ?MntPosibleResultadoElemento
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
