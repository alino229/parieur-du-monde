<?php

namespace App\Repository;

use App\Entity\HomePageMostVisited;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HomePageMostVisited|null find($id, $lockMode = null, $lockVersion = null)
 * @method HomePageMostVisited|null findOneBy(array $criteria, array $orderBy = null)
 * @method HomePageMostVisited[]    findAll()
 * @method HomePageMostVisited[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HomePageMostVisitedRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HomePageMostVisited::class);
    }

    /**
     * @param $value
     * @return HomePageMostVisited|null Returns an array of HomePageMostVisited objects
     * @throws NonUniqueResultException
     */

    public function findPageMostVisited($value): ?HomePageMostVisited
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.article = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    public function  articleMost(): ?array
    {
        return $this->createQueryBuilder('h')
            ->orderBy('h.id', 'DESC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult()
            ;
    }
  /*  /**
     * @return array
     */
    /*public function articleMost(): ?array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT h.article
            FROM App\Entity\HomePageMostVisited h
            ORDER BY h.nbVisite DESC 
           '
        )->setMaxResults(5);

        // returns an array of Product objects
        return $query->getResult();
    }*/


    /*
    public function findOneBySomeField($value): ?HomePageMostVisited
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
