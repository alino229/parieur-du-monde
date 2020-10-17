<?php

namespace App\Controller\Admin;

use App\Entity\ForumTopics;
use App\Form\ForumTopicsType;
use App\Repository\ForumTopicsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/forum/topics")
 */
class ForumTopicsCrudController extends AbstractController
{
    /**
     * @Route("/", name="forum_topics_index", methods={"GET"})
     */
    public function index(ForumTopicsRepository $forumTopicsRepository): Response
    {
        return $this->render('admin/forum_topics/index.html.twig', [
            'forum_topics' => $forumTopicsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="forum_topics_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $forumTopic = new ForumTopics();
        $form = $this->createForm(ForumTopicsType::class, $forumTopic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($forumTopic);
            $entityManager->flush();

            return $this->redirectToRoute('forum_topics_index');
        }

        return $this->render('admin/forum_topics/new.html.twig', [
            'forum_topic' => $forumTopic,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="forum_topics_show", methods={"GET"})
     */
    public function show(ForumTopics $forumTopic): Response
    {
        return $this->render('admin/forum_topics/show.html.twig', [
            'forum_topic' => $forumTopic,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="forum_topics_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ForumTopics $forumTopic): Response
    {
        $form = $this->createForm(ForumTopicsType::class, $forumTopic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('forum_topics_index');
        }

        return $this->render('admin/forum_topics/edit.html.twig', [
            'forum_topic' => $forumTopic,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="forum_topics_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ForumTopics $forumTopic): Response
    {
        if ($this->isCsrfTokenValid('delete'.$forumTopic->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($forumTopic);
            $entityManager->flush();
        }

        return $this->redirectToRoute('forum_topics_index');
    }
}
