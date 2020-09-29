<?php

namespace App\Repository;

use App\Entity\ForumTopics;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ForumTopics|null find($id, $lockMode = null, $lockVersion = null)
 * @method ForumTopics|null findOneBy(array $criteria, array $orderBy = null)
 * @method ForumTopics[]    findAll()
 * @method ForumTopics[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ForumTopicsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ForumTopics::class);
    }

    // /**
    //  * @return ForumTopics[] Returns an array of ForumTopics objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ForumTopics
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
