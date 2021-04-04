<?php

namespace App\Repository;

use App\Entity\MntMedico;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MntMedico|null find($id, $lockMode = null, $lockVersion = null)
 * @method MntMedico|null findOneBy(array $criteria, array $orderBy = null)
 * @method MntMedico[]    findAll()
 * @method MntMedico[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MntMedicoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MntMedico::class);
    }

    // /**
    //  * @return MntMedico[] Returns an array of MntMedico objects
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
    public function findOneBySomeField($value): ?MntMedico
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
