<?php


namespace App\Service;



use App\Entity\Article;
use App\Entity\HomePageMostVisited;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

class QueryGenerator
{
    /**
     * @var EntityManagerInterface
     */
    private $em;
    /**
     * @var Security
     */
    private $security;

    public function __construct(EntityManagerInterface $em,Security $security)
    {
        $this->em = $em;
        $this->security=$security;
    }

    /**
     * @return mixed
     */
    public function articleMost()
    {

        return  $this->em->getRepository(HomePageMostVisited::class)
            ->articleMost();

    }
    /**
     * @return mixed
     */
    public function articles()
    {

        return  $this->em->getRepository(Article::class);

    }




}