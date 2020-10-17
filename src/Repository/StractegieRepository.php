<?php

namespace App\Repository;

use App\Entity\Stractegie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Stractegie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stractegie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stractegie[]    findAll()
 * @method Stractegie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StractegieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Stractegie::class);
    }

    /**
     * @return Stractegie[] Returns an array of Stractegie objects
     */

    public function findAllPublishedOrderByRecentlyActive():array
    {
        return $this->createQueryBuilder('s')
            ->orderBy('s.created_at', 'DESC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult()
        ;
    }
    public function similarStractegies($CurrentPostTitle):array
    {
        $conn = $this->getEntityManager()->getConnection();
        $req="SELECT *, MATCH(titre, contenu)
             AGAINST('$CurrentPostTitle') AS score
            FROM stractegies 
            WHERE MATCH(titre, contenu) AGAINST('$CurrentPostTitle') 
           ORDER BY score DESC LIMIT 5";
        // Build the parameters array

        $stmt = $conn->prepare($req);

           // Execute the query and return the results
        return $stmt->fetchAll();

    }



    public function findStrategieByCategorie($value): ?array
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.category = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }

}
