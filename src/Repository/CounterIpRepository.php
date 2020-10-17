<?php

namespace App\Repository;

use App\Entity\CounterIp;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CounterIp|null find($id, $lockMode = null, $lockVersion = null)
 * @method CounterIp|null findOneBy(array $criteria, array $orderBy = null)
 * @method CounterIp[]    findAll()
 * @method CounterIp[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CounterIpRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CounterIp::class);
    }

    // /**
    //  * @return CounterIp[] Returns an array of CounterIp objects
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
    public function findOneBySomeField($value): ?CounterIp
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
