<?php

namespace App\Controller;

use App\Entity\Forum;
use App\Entity\ForumCategorie;
use App\Entity\ForumMessage;
use App\Entity\ForumReponse;
use App\Entity\Topics;
use App\Entity\User;
use App\Form\ForumMessageType;
use App\Form\ForumReponseType;
use App\Repository\ForumReponseRepository;
use App\Service\Managers;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class ForumController extends AbstractController
{
    public $entityManager;
    public function __construct()
    {

    }

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
           'forumcategories'=>$forumcategories,
            'forum'=>$forum,'topics'=>$topic,'forumreponse'=>$forumreponse
        ]);
    }

    /**
     * @Route("/forum/publie-un-sujet/{id?}", name="forum_sujet", priority=2)
     * @param $id
     * @param Request $request
     * @param TranslatorInterface $translator
     * @param Managers $manager
     * @return Response
     */
    public function createSubject($id,Request $request,TranslatorInterface $translator,Managers $manager ): Response
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
//            $users = $entityManager->getRepository(User::class)->find($this->getUser()->getId());


            $topic->setUser($this->getUser());
            $topic->setSubject($formMessage->getSubject());
            $topic->setCreatedAt(new \DateTime('now'));
            $topic->setForum($formMessage->getForum());
            $entityManager->persist($topic);
            $entityManager->flush();
            $topiclastId=$topic->getId();
            $formMessage->setDate(new \DateTime('now'));
            $formMessage->setUser($this->getUser());
            $formMessage->setTopic($topiclastId);


            $entityManager->persist($formMessage);
            $entityManager->flush();

            $this->addFlash('success','Votre sujet a été ajouté avec succès ');

            return $this->redirectToRoute('forum_discution', ['slug' => $manager->slugify($formMessage->getForum()->getNom())
                ,'sujet'=>$manager->slugify($formMessage->getSubject()),'id'=>$formMessage->getTopic()]);
        }
        return $this->render('forum/sujet_forum.html.twig', [
            'Forumform' => $form->createView()
        ]);
    }

    /**
     * @Route("/forum/{slug}/{sujet}-{id<\d+>?}/{page<\d+>?1}", name="forum_discution", priority=3,requirements={"slug":"([a-z0-9\-]*)|","sujet":"([a-z0-9\-]*)|"})
     * @param $slug
     * @param $sujet
     * @param Managers $managers
     * @param Request $request
     * @param int $page
     * @return Response
     */
    public function discution($slug,$sujet,Managers $managers,  Request $request,int $page): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
           $forumReponse=new ForumReponse();
        $tab=explode('-',$sujet);
        $id=(int)array_slice($tab,-1,1)[0];


        $sujetUsers = $this->getDoctrine()
            ->getRepository(ForumMessage::class)->findOneByNew($id);

        $form = $this->createForm(ForumReponseType::class, $forumReponse);
        $form->handleRequest($request);
//        $users = $entityManager->getRepository(User::class)->find($this->getUser()->getId());
        if ($form->isSubmitted() && $form->isValid()) {
            $forumReponse->setCreatedAt(new \DateTime('now'));
            $forumReponse->setUser($this->getUser());
            $forumReponse->setForum($sujetUsers->getForum());
           $forumReponse->setTopic($sujetUsers->getTopic());
            $entityManager->persist($forumReponse);
            $entityManager->flush();
        }

        $per_page = 3; // Set how many records do you want to display per page.
        $startpoint = ($page * $per_page) - $per_page;


        $reponses= $this->getDoctrine()
            ->getRepository(ForumReponse::class);
        $selectAllreponse=$reponses->selectAllreponse( $id,$startpoint,$per_page);
        $forumPagination=$reponses->forumPagination( $id);

        $url = $this->generateUrl('forum_discution', ['slug' => $slug,'sujet'=>$sujet,'id'=>$id,'page'=>$page]);

        $pagination=$managers->Pagination( $forumPagination,'page',$url ,$page,$per_page);



        return $this->render('Forum/discution.html.twig', ['sujetUsers'=> $sujetUsers,
            'reponses'=> $selectAllreponse,'Forumform' => $form->createView(),'pagination'=>$pagination]);

    }

    /**
     * @Route("/forum/{slug}/{sujet}-{id?}/modifier", name="forum_sujet_modifier", priority=3)
     * @param ForumMessage $authUser
     * @param $id
     * @param Request $request
     * @param TranslatorInterface $translator
     * @return Response
     * @ParamConverter("ForumMessage",class="ForumMessage:ForumMessage")
     * @Security("is_Garanted['ROLE_ADMIN'] and user===authUser.getAuthor()",message="vvvv")
     */
    public function discutionEdit(ForumMessage $authUser ,$id, Request $request, TranslatorInterface $translator): Response
    {
        return $this->render('Forum/discution.html.twig');
    }
}
