<?php

namespace App\Repository;

use App\Entity\ORDERS;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ORDERS|null find($id, $lockMode = null, $lockVersion = null)
 * @method ORDERS|null findOneBy(array $criteria, array $orderBy = null)
 * @method ORDERS[]    findAll()
 * @method ORDERS[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ORDERSRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ORDERS::class);
    }

    // /**
    //  * @return ORDERS[] Returns an array of ORDERS objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ORDERS
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
