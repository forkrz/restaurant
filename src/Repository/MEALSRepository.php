<?php

namespace App\Repository;

use App\Entity\MEALS;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MEALS|null find($id, $lockMode = null, $lockVersion = null)
 * @method MEALS|null findOneBy(array $criteria, array $orderBy = null)
 * @method MEALS[]    findAll()
 * @method MEALS[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MEALSRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MEALS::class);
    }

    // /**
    //  * @return MEALS[] Returns an array of MEALS objects
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
    public function findOneBySomeField($value): ?MEALS
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
