<?php

namespace App\Repository;

use App\Entity\Topics;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Topics|null find($id, $lockMode = null, $lockVersion = null)
 * @method Topics|null findOneBy(array $criteria, array $orderBy = null)
 * @method Topics[]    findAll()
 * @method Topics[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TopicsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Topics::class);
    }
    public function topic(int $id,int $debut=-1,int $limit=-1){
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery("SELECT f FROM App\Entity\ForumMessage f,App\Entity\Topics t,App\Entity\User u 
                        WHERE f.id =t.id AND t.user=u.id AND t.forum=:id GROUP BY f.topic ORDER BY MAX(f.date) DESC "
        )->setFirstResult($debut)
            ->setMaxResults($limit)
            ->setParameter('id', $id);
        return $query->getResult();
    }

    // /**
    //  * @return Topics[] Returns an array of Topics objects
    //  */

    public function countDiscution(int $id)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.forum = :val')
            ->setParameter('val', $id)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @param $id
     * @return mixed
     *
     */
    public function lastSubject($id)
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery("SELECT t  FROM App\Entity\Topics t,App\Entity\User u 
                        WHERE t.forum =:id AND u.id=t.user  ORDER BY t.created_at DESC "
        )  ->setParameter('id', $id);
        if(empty($query->getResult())){
            return $query->getResult();
        }
        return $query->getResult()[0];



    }
    /**
     * @return mixed
     */
    public function totalSujet(){
        return $this->createQueryBuilder('t')
            ->getQuery()
            ->getResult()
            ;
    }


    /*
    public function findOneBySomeField($value): ?Topics
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
