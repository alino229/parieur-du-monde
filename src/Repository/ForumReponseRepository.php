<?php

namespace App\Repository;

use App\Entity\ForumReponse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ForumReponse|null find($id, $lockMode = null, $lockVersion = null)
 * @method ForumReponse|null findOneBy(array $criteria, array $orderBy = null)
 * @method ForumReponse[]    findAll()
 * @method ForumReponse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ForumReponseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ForumReponse::class);
    }

    // /**
    //  * @return ForumReponse[] Returns an array of ForumReponse objects
    //  */

    public function countMessage(int $id)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.forum = :val')
            ->setParameter('val', $id)
            ->getQuery()
            ->getResult()
        ;
    }
    /**
     * @return mixed
     */
    public function totalReponse(){
        return $this->createQueryBuilder('f')
            ->getQuery()
            ->getResult()
            ;
    }
    public function lastMessage(int $id){
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery("SELECT f,MAX(f.created_at) AS maxdate,u.pseudo AS pseudo,f ,u FROM App\Entity\ForumReponse f,App\Entity\User u 
                        WHERE f.topic =:id AND u.id=f.user  ORDER BY maxdate DESC "
        )
            ->setParameter('id', $id);
        return $query->getResult();
    }


    /*
    public function findOneBySomeField($value): ?ForumReponse
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
