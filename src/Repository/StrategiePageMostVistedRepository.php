<?php

namespace App\Repository;

use App\Entity\HomePageMostVisited;
use App\Entity\StrategiePageMostVisted;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StrategiePageMostVisted|null find($id, $lockMode = null, $lockVersion = null)
 * @method StrategiePageMostVisted|null findOneBy(array $criteria, array $orderBy = null)
 * @method StrategiePageMostVisted[]    findAll()
 * @method StrategiePageMostVisted[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StrategiePageMostVistedRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StrategiePageMostVisted::class);
    }

    // /**
    //  * @return StrategiePageMostVisted[] Returns an array of StrategiePageMostVisted objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
    /**
     * @param $value
     * @return StrategiePageMostVisted|null Returns an array of HomePageMostVisited objects
     * @throws NonUniqueResultException
     */

    public function findPageMostVisited($value): ?StrategiePageMostVisted
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.article = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    /*
    public function findOneBySomeField($value): ?StrategiePageMostVisted
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
