<?php

namespace App\Controller;

use App\Entity\Forum;
use App\Entity\ForumCategorie;
use App\Entity\ForumMessage;
use App\Entity\ForumReponse;
use App\Entity\Topics;
use App\Entity\User;
use App\Form\ForumMessageType;
use App\Repository\ForumReponseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class ForumController extends AbstractController
{
    /**
     * @Route("/forum", name="forum")
     */
    public function index()
    {

        $forumcategories = $this->getDoctrine()
            ->getRepository(ForumCategorie::class)
            ->findAll();
        $forum = $this->getDoctrine()
            ->getRepository(Forum::class);
        $Discution=$this->getDoctrine()
            ->getRepository(Topics::class)
           ;
        $Message=$this->getDoctrine()
            ->getRepository(ForumReponse::class)
           ;
        $ForumMessage=$this->getDoctrine()
            ->getRepository(ForumMessage::class)
        ;
        $User=$this->getDoctrine()
            ->getRepository(User::class)
        ;
        return $this->render('forum/index.html.twig', [
            'controller_name' => 'ForumController','forumcategories'=>$forumcategories,
            'forum'=>$forum,'Discution'=>$Discution,'Message'=>$Message,'forummessage'=>$ForumMessage,
            'user'=>$User
        ]);
    }

    /**
     * @Route("/forum/{slug}-{id}", name="forum_show",requirements={"slug":"([a-z0-9\-]*)|"})
     * @param $id
     * @return Response
     */
    public function show($id)
    {

        $forumcategories = $this->getDoctrine()
            ->getRepository(ForumCategorie::class)
            ->findAll();
        $forum  = $this->getDoctrine()
            ->getRepository(Forum::class)->find($id);
        $topic  = $this->getDoctrine()
            ->getRepository(Topics::class)->topic($id,0,10);

        $forumreponse = $this->getDoctrine()
            ->getRepository(ForumReponse::class)
            ;
        return $this->render('forum/show_forum.html.twig', [
            'controller_name' => 'ForumController','forumcategories'=>$forumcategories,
            'forum'=>$forum,'topics'=>$topic,'forumreponse'=>$forumreponse
        ]);
    }

    /**
     * @Route("/forum/publie-un-sujet/{id?}", name="forum_sujet", priority=2)
     * @param $id
     * @param Request $request
     * @param TranslatorInterface $translator
     * @return Response
     */
    public function createSubject($id,Request $request,TranslatorInterface $translator): Response
    {


        $entityManager = $this->getDoctrine()->getManager();
        $formMessage = new ForumMessage();
        $topic= new Topics();
        $user=new User();
        $form = $this->createForm(ForumMessageType::class, $formMessage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           /* $users =$entityManager->getRepository(User::class)->find($this->getUser()->getId());

            $user->setPseudo($users);

          $entityManager->persist($user);
          $entityManager->flush();*/
            $users = $entityManager->getRepository(User::class)->find($this->getUser()->getId());


            $topic->setUser($users);
            $topic->setSubject($formMessage->getSubject());
            $topic->setCreatedAt(new \DateTime('now'));
            $topic->setForum($formMessage->getForum());
            $entityManager->persist($topic);
            $entityManager->flush();
            $topiclastId=$topic->getId();
            $formMessage->setDate(new \DateTime('now'));
            $formMessage->setUser($users);
            $formMessage->setTopic($topiclastId);

            $entityManager->persist($formMessage);
            $entityManager->flush();
            return $this->redirectToRoute('home');
//            $this->addFlash('success','Jūsu pieprasījums ir saņemts');
        }
        return $this->render('forum/sujet_forum.html.twig', [
            'controller_name' => 'ForumController', 'Forumform' => $form->createView()
        ]);
    }
}
