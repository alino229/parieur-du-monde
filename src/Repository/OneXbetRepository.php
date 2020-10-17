<?php

namespace App\Repository;

use App\Entity\OneXbet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OneXbet|null find($id, $lockMode = null, $lockVersion = null)
 * @method OneXbet|null findOneBy(array $criteria, array $orderBy = null)
 * @method OneXbet[]    findAll()
 * @method OneXbet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OneXbetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OneXbet::class);
    }

    // /**
    //  * @return OneXbet[] Returns an array of OneXbet objects
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
    public function findOneBySomeField($value): ?OneXbet
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
