<?php

namespace App\Controller;

use App\Entity\HomePageMostVisited;
use App\Entity\Stractegie;
use App\Entity\StrategieCategorie;
use App\Entity\StrategiePageMostVisted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StrategieController extends AbstractController
{
    /**
     * @Route("/strategies", name="strategie")
     */
    public function index()
    {
        $allCategorie = $this->getDoctrine()
            ->getRepository(StrategieCategorie::class)
            ->findAll();
        $allStractegie = $this->getDoctrine()
            ->getRepository(Stractegie::class);
        $allStractegieresent=$allStractegie->resentStractegie();

        return $this->render('strategie/index.html.twig', [
            'controller_name' => 'StrategieController','allCategorie'=>$allCategorie,
            'allStractegie'=>$allStractegie,'allStractegieresent'=>$allStractegieresent
        ]);
    }

    /**
     * @Route("/strategies/{slug}-{id}", name="app_strategie_show",requirements={"slug":"([a-z0-9\-]*)|"})
     * @param $id
     * @param $slug
     * @return Response
     */
    public function show($id,$slug)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $allCategorie = $this->getDoctrine()
            ->getRepository(StrategieCategorie::class)
            ->findAll();
        $allStractegie = $this->getDoctrine()
            ->getRepository(Stractegie::class)->find($id);
        $similarStractegies = $this->getDoctrine()
            ->getRepository(Stractegie::class)->similarStractegies($id);
        $pagemostvisited=new StrategiePageMostVisted();

        $findPage = $this->getDoctrine()
            ->getRepository(StrategiePageMostVisted::class)
            ->findPageMostVisited($id);


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



        return $this->render('strategie/show.html.twig', [
            'controller_name' => 'StrategieController','allCategorie'=>$allCategorie,
            'news'=>$allStractegie,'similarStractegies'=>$similarStractegies,'findPage'=>$findPage
        ]);
    }
}
