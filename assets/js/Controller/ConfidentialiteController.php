<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ConfidentialiteController extends AbstractController
{
    /**
     * @Route("/confidentialite", name="confidentialite")
     */
    public function index()
    {
        return $this->render('confidentialite/index.html.twig', [
            'controller_name' => 'ConfidentialiteController',
        ]);
    }
}
