<?php

namespace App\Repository;

use App\Entity\ForumSujet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ForumSujet|null find($id, $lockMode = null, $lockVersion = null)
 * @method ForumSujet|null findOneBy(array $criteria, array $orderBy = null)
 * @method ForumSujet[]    findAll()
 * @method ForumSujet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ForumSujetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ForumSujet::class);
    }

    // /**
    //  * @return ForumSujet[] Returns an array of ForumSujet objects
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
    public function findOneBySomeField($value): ?ForumSujet
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
