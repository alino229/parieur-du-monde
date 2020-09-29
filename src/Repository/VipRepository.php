<?php

namespace App\Repository;

use App\Entity\Vip;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Vip|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vip|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vip[]    findAll()
 * @method Vip[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VipRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vip::class);
    }


    /**
     * @param $value
     * @param $user
     * @return int|mixed|string|null
     * @throws NonUniqueResultException
     */
    public function vipActivation($value,$user)
    {

        return $this->createQueryBuilder('v')
            ->andWhere('v.active = :val','v.user= :user')
            ->setParameters(array('val'=>$value,'user'=>$user))
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?Vip
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
