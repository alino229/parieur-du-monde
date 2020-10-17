<?php

namespace App\Controller\Admin;

use App\Entity\ForumMessage;
use App\Form\ForumMessage1Type;
use App\Repository\ForumMessageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/forum/message")
 */
class ForumMessageCrudController extends AbstractController
{
    /**
     * @Route("/", name="forum_message_index", methods={"GET"})
     */
    public function index(ForumMessageRepository $forumMessageRepository): Response
    {
        return $this->render('admin/forum_message/index.html.twig', [
            'forum_messages' => $forumMessageRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="forum_message_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $forumMessage = new ForumMessage();
        $form = $this->createForm(ForumMessage1Type::class, $forumMessage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($forumMessage);
            $entityManager->flush();

            return $this->redirectToRoute('forum_message_index');
        }

        return $this->render('admin/forum_message/new.html.twig', [
            'forum_message' => $forumMessage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="forum_message_show", methods={"GET"})
     */
    public function show(ForumMessage $forumMessage): Response
    {
        return $this->render('admin/forum_message/show.html.twig', [
            'forum_message' => $forumMessage,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="forum_message_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ForumMessage $forumMessage): Response
    {
        $form = $this->createForm(ForumMessage1Type::class, $forumMessage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('forum_message_index');
        }

        return $this->render('admin/forum_message/edit.html.twig', [
            'forum_message' => $forumMessage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="forum_message_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ForumMessage $forumMessage): Response
    {
        if ($this->isCsrfTokenValid('delete'.$forumMessage->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($forumMessage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('forum_message_index');
    }
}
