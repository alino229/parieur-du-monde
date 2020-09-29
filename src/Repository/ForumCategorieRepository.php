<?php

namespace App\Repository;

use App\Entity\ForumCategorie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ForumCategorie|null find($id, $lockMode = null, $lockVersion = null)
 * @method ForumCategorie|null findOneBy(array $criteria, array $orderBy = null)
 * @method ForumCategorie[]    findAll()
 * @method ForumCategorie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ForumCategorieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ForumCategorie::class);
    }

    // /**
    //  * @return ForumCategorie[] Returns an array of ForumCategorie objects
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
    public function findOneBySomeField($value): ?ForumCategorie
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
