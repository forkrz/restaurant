<?php

namespace App\Repository;

use App\Entity\ADMINDATA;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ADMINDATA|null find($id, $lockMode = null, $lockVersion = null)
 * @method ADMINDATA|null findOneBy(array $criteria, array $orderBy = null)
 * @method ADMINDATA[]    findAll()
 * @method ADMINDATA[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ADMINDATARepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ADMINDATA::class);
    }

    // /**
    //  * @return ADMINDATA[] Returns an array of ADMINDATA objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ADMINDATA
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
