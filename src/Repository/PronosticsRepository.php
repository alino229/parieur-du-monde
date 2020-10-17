<?php

namespace App\Repository;

use App\Entity\CategoriePronostics;
use App\Entity\Pronostics;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Pronostics|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pronostics|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pronostics[]    findAll()
 * @method Pronostics[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PronosticsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pronostics::class);
    }

     /**
    * @return Pronostics[] Returns an array of Pronostics objects
     */

    public function newPronosticsField(): array
    {
        $params = array (


             ':publie'=>true,
            ':val'=>5
        );

        return $this->createQueryBuilder('p')

            ->innerJoin(CategoriePronostics::class,'pc')
            ->Where('p.resultat is NULL')
            ->andWhere('p.published = :publie','pc.id= :val')
            ->setParameters($params)
            ->orderBy('p.id', 'DESC')
            ->setFirstResult(0)
            ->setMaxResults(2)
            ->getQuery()
            ->getResult()
        ;
    }
    /**
     * @return Pronostics[] Returns an array of Pronostics objects
     */

    public function newPronostics2Field(): array
    {
        $params = array (


            ':publie'=>true,
            ':val'=>5
        );

        return $this->createQueryBuilder('p')

            ->innerJoin(CategoriePronostics::class,'pc')
            ->Where('p.resultat is NULL')
            ->andWhere('p.published = :publie','pc.id= :val')
            ->setParameters($params)
            ->orderBy('p.id', 'DESC')
            ->setFirstResult(2)
            ->setMaxResults(2)
            ->getQuery()
            ->getResult()
            ;
    }
    /**
     * @return Pronostics[] Returns an array of Pronostics objects
     */

    public function newPronostics3Field(): array
    {
        $params = array (


            ':publie'=>true,
            ':val'=>5
        );

        return $this->createQueryBuilder('p')

            ->innerJoin(CategoriePronostics::class,'pc')
            ->Where('p.resultat is NULL')
            ->andWhere('p.published = :publie','pc.id= :val')
            ->setParameters($params)
            ->orderBy('p.id', 'DESC')
            ->setFirstResult(4)
            ->setMaxResults(2)
            ->getQuery()
            ->getResult()
            ;
    }
    public function newPronostics4Field(): array
    {
        $params = array (


            ':publie'=>true,
            ':val'=>5
        );

        return $this->createQueryBuilder('p')

            ->innerJoin(CategoriePronostics::class,'pc')
            ->Where('p.resultat is NULL')
            ->andWhere('p.published = :publie','pc.id= :val')
            ->setParameters($params)
            ->orderBy('p.id', 'DESC')
            ->setFirstResult(6)
            ->setMaxResults(2)
            ->getQuery()
            ->getResult()
            ;
    }

    public function newPronostics5Field(): array
    {
        $params = array (


            ':publie'=>true,
            ':val'=>5
        );

        return $this->createQueryBuilder('p')

            ->innerJoin(CategoriePronostics::class,'pc')
            ->Where('p.resultat is NULL')
            ->andWhere('p.published = :publie','pc.id= :val')
            ->setParameters($params)
            ->orderBy('p.id', 'DESC')
            ->setFirstResult(8)
            ->setMaxResults(2)
            ->getQuery()
            ->getResult()
            ;
    }
    public function showPronosticsResult(): array
    {
        $params = array (

            ':val'=>5,
            ':publie'=>true);

        return $this->createQueryBuilder('p')
            ->innerJoin(CategoriePronostics::class,'pc')
            ->Where('p.resultat is NOT NULL')
            ->andWhere('p.published = :publie','pc.id= :val')
            ->setParameters($params)
            ->getQuery()
            ->getResult()
            ;
    }
    public function showPronosticsResult1(): array
    {
        $params = array (

            ':val'=>'null',
            ':publie'=>true);

        return $this->createQueryBuilder('p')
            ->andWhere('p.resultat != :val','p.published = :publie')
            ->setParameters($params)
            ->orderBy('p.id', 'ASC')
            ->setFirstResult(0)
            ->setMaxResults(2)
            ->getQuery()
            ->getResult()
            ;
    }
    public function showPronosticsResult2(): array
    {
        $params = array (

            ':val'=>'null',
            ':publie'=>true);

        return $this->createQueryBuilder('p')
            ->andWhere('p.resultat != :val','p.published = :publie')
            ->setParameters($params)
            ->orderBy('p.id', 'DESC')
            ->setFirstResult(2)
            ->setMaxResults(2)
            ->getQuery()
            ->getResult()
            ;
    }
    public function showPronosticsResult3(): array
    {
        $params = array (

            ':val'=>'null',
            ':publie'=>true);

        return $this->createQueryBuilder('p')
            ->andWhere('p.resultat != :val','p.published = :publie')
            ->setParameters($params)
            ->orderBy('p.id', 'DESC')
            ->setFirstResult(4)
            ->setMaxResults(2)
            ->getQuery()
            ->getResult()
            ;
    }
    public function showPronosticsResult4(): array
    {
        $params = array (

            ':val'=>'null',
            ':publie'=>true);

        return $this->createQueryBuilder('p')
            ->andWhere('p.resultat != :val','p.published = :publie')
            ->setParameters($params)
            ->orderBy('p.id', 'DESC')
            ->setFirstResult(6)
            ->setMaxResults(2)
            ->getQuery()
            ->getResult()
            ;
    }
    public function showPronosticsResult5(): array
    {
        $params = array (

            ':val'=>'null',
            ':publie'=>true);

        return $this->createQueryBuilder('p')
            ->andWhere('p.resultat != :val','p.published = :publie')
            ->setParameters($params)
            ->orderBy('p.id', 'DESC')
            ->setFirstResult(8)
            ->setMaxResults(2)
            ->getQuery()
            ->getResult()
            ;
    }
    /**
     * @return Pronostics[] Returns an array of Pronostics objects
     */

    public function VipronosticsCombo(): array
    {
        $params = array (

            ':val'=>'null',
            ':publie'=>true,':cat'=>'COMBO');

        return $this->createQueryBuilder('p')
            ->andWhere('p.resultat = :val','p.published = :publie','p.category=:cat')
            ->setParameters($params)
            ->orderBy('p.id', 'DESC')
            ->setFirstResult(0)
            ->setMaxResults(2)
            ->getQuery()
            ->getResult()
            ;
    }
    /**
     * @return Pronostics[] Returns an array of Pronostics objects
     */
    public function VipronosticsSpecial(): array
    {
        $params = array (

            ':val'=>'null',
            ':publie'=>true,':cat'=>'SPECIAL');

        return $this->createQueryBuilder('p')
            ->andWhere('p.resultat = :val','p.published = :publie','p.category=:cat')
            ->setParameters($params)
            ->orderBy('p.id', 'DESC')
            ->setFirstResult(0)
            ->setMaxResults(4)
            ->getQuery()
            ->getResult()
            ;
    }
    /**
     * @return Pronostics[] Returns an array of Pronostics objects
     */
    public function VipronosticsWeek(): array
    {
        $params = array (

            ':val'=>'null',
            ':publie'=>true,':cat'=>'WEEK');

        return $this->createQueryBuilder('p')
            ->andWhere('p.resultat = :val','p.published = :publie','p.category=:cat')
            ->setParameters($params)
            ->orderBy('p.id', 'DESC')
            ->setFirstResult(0)
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
    }



    /*
    public function findOneBySomeField($value): ?Pronostics
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
