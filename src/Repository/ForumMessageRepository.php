<?php

namespace App\Repository;

use App\Entity\ForumMessage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ForumMessage|null find($id, $lockMode = null, $lockVersion = null)
 * @method ForumMessage|null findOneBy(array $criteria, array $orderBy = null)
 * @method ForumMessage[]    findAll()
 * @method ForumMessage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ForumMessageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ForumMessage::class);
    }

    /**
     * @param $id
     * @return mixed
     * @throws NonUniqueResultException
     */
    public function discution(int $id){
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery("SELECT f.body,f.subject, u.pseudo AS pseudo,u.email,u.avatar  FROM App\Entity\ForumMessage f,App\Entity\User u 
                        WHERE f.user =u.id AND f.topic=:id  ORDER BY f.date DESC "
        )
            ->setParameter('id', $id);
        return $query->getOneOrNullResult();
    }



    // /**
    //  * @return ForumMessage[] Returns an array of ForumMessage objects
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

    /**
     *
     * @param $value
     * @return ForumMessage|null
     * @throws NonUniqueResultException
     */
    public function findOneByNew($value): ?ForumMessage
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.topic = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

}
