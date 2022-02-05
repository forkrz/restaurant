<?php

namespace App\Repository;

use App\Entity\ORDERDETAILS;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ORDERDETAILS|null find($id, $lockMode = null, $lockVersion = null)
 * @method ORDERDETAILS|null findOneBy(array $criteria, array $orderBy = null)
 * @method ORDERDETAILS[]    findAll()
 * @method ORDERDETAILS[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ORDERDETAILSRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ORDERDETAILS::class);
    }

    // /**
    //  * @return ORDERDETAILS[] Returns an array of ORDERDETAILS objects
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
    public function findOneBySomeField($value): ?ORDERDETAILS
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
