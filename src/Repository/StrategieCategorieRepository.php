<?php

namespace App\Repository;

use App\Entity\StrategieCategorie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StrategieCategorie|null find($id, $lockMode = null, $lockVersion = null)
 * @method StrategieCategorie|null findOneBy(array $criteria, array $orderBy = null)
 * @method StrategieCategorie[]    findAll()
 * @method StrategieCategorie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StrategieCategorieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StrategieCategorie::class);
    }

    // /**
    //  * @return StrategieCategorie[] Returns an array of StrategieCategorie objects
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

    /*
    public function findOneBySomeField($value): ?StrategieCategorie
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
