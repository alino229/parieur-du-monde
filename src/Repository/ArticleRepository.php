<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

   /**
   * @return Article[] Returns an array of Article objects
    */

    public function findAllArticle(): array
    {
        $conn = $this->getEntityManager()->getConnection();

        // Retrieve the list of products
        $sql = 'CALL get_all_home_article()';
      // Build the parameters array

        $stmt = $conn->prepare($sql);
        $stmt->execute();
     // Execute the query and return the results
        return $stmt->fetchAll();
    }
    public function findPublishedArticle($startpoint,$per_page)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.published = :val')
            ->setParameter('val', true)
            ->orderBy('a.created_at', 'DESC')
            ->setFirstResult($startpoint)
            ->setMaxResults($per_page)

            ->getQuery()
            ->getResult()
            ;
    }
    public function ArticlePagination()
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.published = :val')
            ->setParameter('val', true)
            ->orderBy('a.created_at', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }



    public function findPageMostVisited($value): ?Article
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    public function pageMostVisited($value){
        if($this->findPageMostVisited($value)===null){
            $nb_visite=1;

        }

    }
    /**
     * @return
     */
    public function findAllGreaterThanPrice($price): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p
            FROM App\Entity\Product p
            WHERE p.price > :price
            ORDER BY p.price ASC'
        )->setParameter('price', $price);

        // returns an array of Product objects
        return $query->getResult();
    }


}
