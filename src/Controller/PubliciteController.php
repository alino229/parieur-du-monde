<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PubliciteController extends AbstractController
{
    /**
     * @Route("/publicite", name="publicite")
     */
    public function index()
    {
        return $this->render('publicite/index.html.twig', [
            'controller_name' => 'PubliciteController',
        ]);
    }
}
