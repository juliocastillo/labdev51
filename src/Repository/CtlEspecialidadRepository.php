<?php

namespace App\Repository;

use App\Entity\CtlEspecialidad;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CtlEspecialidad|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtlEspecialidad|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtlEspecialidad[]    findAll()
 * @method CtlEspecialidad[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtlEspecialidadRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtlEspecialidad::class);
    }

    // /**
    //  * @return CtlEspecialidad[] Returns an array of CtlEspecialidad objects
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
    public function findOneBySomeField($value): ?CtlEspecialidad
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
