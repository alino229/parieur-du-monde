<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    /**
     * @Route("/compte/utilisateur", name="account")
     * @Security("is_granted('ROLE_USER')", statusCode=404, message="Resource not found.")
     */
    public function index()
    {
        return $this->render('account/index.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }
    /**
     * @Route("/profil/utilisateur", name="user_profil")
     * @Security("is_granted('ROLE_USER')", statusCode=404, message="Resource not found.")
     */
    public function profil()
    {
        return $this->render('account/profil.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }
    /**
     * @Route("/parrainage/utilisateur", name="user_parrainage")
     * @Security("is_granted('ROLE_USER')", statusCode=404, message="Resource not found.")
     */
    public function parrainage()
    {
        return $this->render('account/parrainage.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }
    /**
     * @Route("/payement/utilisateur", name="user_payement")
     * @Security("is_granted('ROLE_USER')", statusCode=404, message="Resource not found.")
     */
    public function payement()
    {
        return $this->render('account/payement.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }
    /**
     * @Route("/alert/utilisateur", name="user_alert")
     * @Security("is_granted('ROLE_USER')", statusCode=404, message="Resource not found.")
     */
    public function alert()
    {
        return $this->render('account/alert.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }
    /**
     * @Route("/reaction/utilisateur", name="user_reaction")
     * @Security("is_granted('ROLE_USER')", statusCode=404, message="Resource not found.")
     */
    public function reaction()
    {
        return $this->render('account/reaction.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }
    /**
     * @Route("/alert/utilisateur", name="user_favorie")
     * @Security("is_granted('ROLE_USER')", statusCode=404, message="Resource not found.")
     */
    public function favorie()
    {
        return $this->render('account/favorie.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }

    /**
     * @Route("/alert/utilisateur", name="user_forum")
     * @Security("is_granted('ROLE_USER')", statusCode=404, message="Resource not found.")
     */
    public function message()
    {
        return $this->render('account/message.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }
}
