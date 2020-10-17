<?php

namespace App\Controller\Admin;

use App\Entity\ForumReponse;
use App\Form\ForumReponse1Type;
use App\Repository\ForumReponseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/forum/reponse")
 */
class ForumReponseCrudController extends AbstractController
{
    /**
     * @Route("/", name="forum_reponse_index", methods={"GET"})
     */
    public function index(ForumReponseRepository $forumReponseRepository): Response
    {
        return $this->render('admin/forum_reponse/index.html.twig', [
            'forum_reponses' => $forumReponseRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="forum_reponse_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $forumReponse = new ForumReponse();
        $form = $this->createForm(ForumReponse1Type::class, $forumReponse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($forumReponse);
            $entityManager->flush();

            return $this->redirectToRoute('forum_reponse_index');
        }

        return $this->render('admin/forum_reponse/new.html.twig', [
            'forum_reponse' => $forumReponse,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="forum_reponse_show", methods={"GET"})
     */
    public function show(ForumReponse $forumReponse): Response
    {
        return $this->render('admin/forum_reponse/show.html.twig', [
            'forum_reponse' => $forumReponse,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="forum_reponse_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ForumReponse $forumReponse): Response
    {
        $form = $this->createForm(ForumReponse1Type::class, $forumReponse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('forum_reponse_index');
        }

        return $this->render('admin/forum_reponse/edit.html.twig', [
            'forum_reponse' => $forumReponse,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="forum_reponse_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ForumReponse $forumReponse): Response
    {
        if ($this->isCsrfTokenValid('delete'.$forumReponse->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($forumReponse);
            $entityManager->flush();
        }

        return $this->redirectToRoute('forum_reponse_index');
    }
}
