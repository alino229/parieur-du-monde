<?php


namespace App\Controller;


use App\Entity\Pronostics;
use App\Entity\User;
use App\Entity\Vip;
use App\Service\Managers;
use Faker\Factory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PronosticsController extends AbstractController
{
    /**
     * @Route("/pronostics", name="pronostics")
     * @return Response
     */
    public function index(): Response
    {
        $pronostics = $this->getDoctrine()
            ->getRepository(Pronostics::class);

        $newProno= $pronostics->newPronosticsField();


        $newProno2= $pronostics->newPronostics2Field();
        $newProno4= $pronostics->newPronostics3Field();
        $newProno3= $pronostics->newPronostics4Field();
        $newProno5= $pronostics->newPronostics5Field();
        $showResult=$pronostics->showPronosticsResult();




        return $this->render('pronostics/index.html.twig', ['newProno'=> $newProno,
            'newProno2'=>$newProno2,'newProno3'=>$newProno3,'newProno4'=>$newProno4
            ,'newProno5'=>$newProno5,'showResult'=> $showResult

        ]);
    }
    /**
     * @Route("/pronostics/resultats", name="pronostics_resultats")
     * @return Response
     */
    public function show(): Response
    {

        $showResult=$this->getDoctrine()
            ->getRepository(Pronostics::class);
        $showResult1=$showResult->showPronosticsResult1();
        $showResult2=$showResult->showPronosticsResult2();
        $showResult3=$showResult->showPronosticsResult3();
        $showResult4=$showResult->showPronosticsResult4();
        $showResult5=$showResult->showPronosticsResult5();




        return $this->render('pronostics/resultats.html.twig', ['showResult1'=> $showResult1,
            'showResult2'=> $showResult2,'showResult3'=> $showResult3,'showResult4'=> $showResult4,
            'showResult5'=> $showResult5,

        ]);
    }
    /**
     * @Route("/pronostics/premium", name="pronostics_premium")
     * @return Response
     */
    public function premium(): Response
{
    // usually you'll want to make sure the user is authenticated first


    // returns your User object, or null if the user is not authenticated
    // use inline documentation to tell your editor your exact User class
    /** @var User $user */
    $user = $this->getUser();

    $vip=new Vip();
    $showResult=$this->getDoctrine()
        ->getRepository(Vip::class);


    if(!$user){
        return $this->redirectToRoute('app_use_login');
    }elseif($user->getVip()===null){
        return $this->redirectToRoute('pronostics_premiums');
    }
    elseif (!$user->getVip()->getActive()){
        return $this->redirectToRoute('pronostics_premiums');
    }
    $pronostics = $this->getDoctrine()
        ->getRepository(Pronostics::class);
    $combo=$pronostics->VipronosticsCombo();
    $special=$pronostics->VipronosticsSpecial();
    $week=$pronostics->VipronosticsWeek();





    return $this->render('Pronostics/premium.html.twig',['combo'=>$combo,'special'=>$special,
        'week'=>$week]);


}

    /**
     * @Route("/pronostics/conseil", name="pronostics_conseil")
     * @return Response
     */
    public function conseils(): Response
    {


        return $this->render('Pronostics/conseils.html.twig',[
        ]);



    }
    /**
     * @Route("/pronostics/premiums", name="pronostics_premiums")
     * @return Response
     */
    public function premiums(): Response
    {



        return $this->render('Pronostics/premiums.html.twig',[
        ]);



    }

    /**
     * @Route("/pronostics/premium/resultats", name="pronostics_premium_resultat")
     * @return Response
     */
    public function resultats(): Response
    {


        return $this->render('Pronostics/resultats.html.twig', []);

        }


    /**
     * @Route("/pronostics/premium/paiement", name="pronostics_premium_paiement")
     * @return Response
     */
    public function paiement(): Response
    {

        return $this->render('Pronostics/paiement.html.twig', [ ]);

    }

}