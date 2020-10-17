<?php

namespace App\Repository;

use App\Entity\CounterValue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CounterValue|null find($id, $lockMode = null, $lockVersion = null)
 * @method CounterValue|null findOneBy(array $criteria, array $orderBy = null)
 * @method CounterValue[]    findAll()
 * @method CounterValue[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CounterValueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CounterValue::class);
    }

    // /**
    //  * @return CounterValue[] Returns an array of CounterValue objects
    //  */

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



    public function findOne(): ?CounterValue
    {
        return $this->createQueryBuilder('c')
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

}
