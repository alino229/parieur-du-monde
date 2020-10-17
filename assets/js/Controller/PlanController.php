<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PlanController extends AbstractController
{
    /**
     * @Route("/plan-du-site", name="plan", priority=5)
     */
    public function index()
    {
        return $this->render('plan/index.html.twig', [

        ]);
    }
}
