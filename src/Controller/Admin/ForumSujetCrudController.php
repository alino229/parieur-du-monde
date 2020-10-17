<?php

namespace App\Controller\Admin;

use App\Entity\ForumSujet;
use App\Form\ForumSujetType;
use App\Repository\ForumSujetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/forum/sujet")
 */
class ForumSujetCrudController extends AbstractController
{
    /**
     * @Route("/", name="forum_sujet_index", methods={"GET"})
     */
    public function index(ForumSujetRepository $forumSujetRepository): Response
    {
        return $this->render('admin/forum_sujet/index.html.twig', [
            'forum_sujets' => $forumSujetRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="forum_sujet_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $forumSujet = new ForumSujet();
        $form = $this->createForm(ForumSujetType::class, $forumSujet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($forumSujet);
            $entityManager->flush();

            return $this->redirectToRoute('forum_sujet_index');
        }

        return $this->render('admin/forum_sujet/new.html.twig', [
            'forum_sujet' => $forumSujet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="forum_sujet_show", methods={"GET"})
     */
    public function show(ForumSujet $forumSujet): Response
    {
        return $this->render('admin/forum_sujet/show.html.twig', [
            'forum_sujet' => $forumSujet,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="forum_sujet_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ForumSujet $forumSujet): Response
    {
        $form = $this->createForm(ForumSujetType::class, $forumSujet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('forum_sujet_index');
        }

        return $this->render('admin/forum_sujet/edit.html.twig', [
            'forum_sujet' => $forumSujet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="forum_sujet_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ForumSujet $forumSujet): Response
    {
        if ($this->isCsrfTokenValid('delete'.$forumSujet->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($forumSujet);
            $entityManager->flush();
        }

        return $this->redirectToRoute('forum_sujet_index');
    }
}
