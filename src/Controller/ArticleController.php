<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Commentaire;
use App\Entity\Contact;
use App\Entity\Forum;
use App\Entity\ForumCategorie;
use App\Entity\HomePageMostVisited;
use App\Entity\User;
use App\Form\CommentaireType;
use Faker\Factory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Managers;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class ArticleController extends AbstractController
{
//    /**
//     * @return string
//     */
//    private function _GetPageTitle()
//    {
//        $page_title = 'Afrique-shopping: ' .
//            ' Informatique, Smartphones, livres, jeux vidéo, photos, jouets, électroménager neuf et occasion';
//        if (isset ($_GET['DepartmentId']) && isset ($_GET['CategoryId']))
//        {
//            $page_title = 'TShirtShop: ' .
//                Manager::GetDepartmentName($_GET['DepartmentId']) . ' - ' .
//                Manager::GetCategoryName($_GET['CategoryId']);
//            if (isset ($_GET['Page']) && ((int)$_GET['Page']) > 1)
//                $page_title .= ' - Page ' . ((int)$_GET['Page']);
//        }
//        elseif (isset ($_GET['DepartmentId']))
//        {
//            $page_title = 'TShirtShop: ' .
//                Manager::GetDepartmentName($_GET['DepartmentId']);
//            if (isset ($_GET['Page']) && ((int)$_GET['Page']) > 1)
//                $page_title .= ' - Page ' . ((int)$_GET['Page']);
//        }
//        elseif (isset ($_GET['ProductId']))
//        {
//            $page_title = 'TShirtShop: ' .
//                Manager::GetProductName($_GET['ProductId']);
//        }
//        else
//        {
//            if (isset ($_GET['Page']) && ((int)$_GET['Page']) > 1)
//                $page_title .= ' - Page ' . ((int)$_GET['Page']);
//        }
//        return $page_title;
//
//    }
    /**
     * @Route("/{id<\d>?1}", name="home")
     * @param Managers $managers
     * @param $id
     * @return Response
     */
    public function index(Managers $managers,$id): Response
    {
        $faker = Factory::create('fr_FR');



        // create 20 products! Bam!
      /* $entityManager = $this->getDoctrine()->getManager();
        for ($i = 0; $i < 1; $i++) {
            $article = new Forum();
            $art = new ForumCategorie();

            $article->setNom($faker->words(3,true));
            $article->setDescription($faker->text);
            $article->setCategory($art);
           /* $article->setEmail($faker->email);
            $article->setMessage($faker->words(40,true));
            $article->setSite($faker->url);
            $article->setCreatedAt($faker->dateTime);*/

//            $entityManager->persist(  $article);
//        }
//        $entityManager->flush();*/
        $page =  $id;
        $per_page = 6; // Set how many records do you want to display per page.
        $startpoint = ($page * $per_page) - $per_page;
        $article =$this->getDoctrine()
            ->getRepository(Article::class);
        $findPublishedArticle =$article ->findPublishedArticle($startpoint,$per_page);

        $ArticlePagination =$article->ArticlePagination();
        $pagination=$managers->Pagination($ArticlePagination,'page',$page,$per_page);


        return $this->render('article/index.html.twig', [
            'article' => $findPublishedArticle,'pagination'=>$pagination
        ]);
    }

    /**
     ** @Route("/{slug}-{id}",requirements={"slug":"([a-z0-9\-]*)|"}, name="article_show")
     * @param $id
     * @param Request $request
     * @return Response
     */
    public function show($id,Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $articles = $this->getDoctrine()
            ->getRepository(Article::class);



        $pagemostvisited=new HomePageMostVisited();

        $findPage = $this->getDoctrine()
            ->getRepository(HomePageMostVisited::class)
            ->findPageMostVisited($id);
        $articleMost = $this->getDoctrine()
            ->getRepository(HomePageMostVisited::class)
            ->articleMost();



   if($findPage===null){
            $nb_visite=1;
            $pagemostvisited->setArticle($id);
            $pagemostvisited->setNbVisite($nb_visite);
            $pagemostvisited->setTimestamp(new \DateTime('now'));
       $entityManager->persist($pagemostvisited);

   }else{

            $visite=$findPage->getNbVisite();

            $visite=$visite + 1;


       $findPage->setNbVisite($visite);
       $findPage->setTimestamp(new \DateTime('now'));

        }

        $entityManager->flush();

        $Commentaire = new Commentaire();

        $form = $this->createForm(CommentaireType::class, $Commentaire);
        $form->handleRequest($request);
        $articleU =$entityManager->getRepository(Article::class)->find($id);


        if ($form->isSubmitted() && $form->isValid()) {

            $Commentaire->setCreatedAt(new \DateTime('now'));
            $Commentaire->setArticle($articleU);
            if($this->getUser()){
                $Commentaire->setPseudo($this->getUser()->getPseudo());
                $Commentaire->setEmail($this->getUser()->getEmail());
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($Commentaire);

            $entityManager->flush();
            $this->addFlash('success','Commentaire poster avec succès ');
        }
        $articles = $this->getDoctrine()
            ->getRepository(Article::class);
        $article=$articles->find($id);
        return $this->render('article/show.html.twig', [
            'news' => $article,'CommentaireForm' => $form->createView(),
            'findPage'=>$findPage
        ]);
    }
}
