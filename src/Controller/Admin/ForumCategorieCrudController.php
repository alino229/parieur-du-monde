<?php

namespace App\Controller\Admin;

use App\Entity\ForumCategorie;
use App\Form\ForumCategorieType;
use App\Repository\ForumCategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/forum/categorie")
 */
class ForumCategorieCrudController extends AbstractController
{
    /**
     * @Route("/", name="forum_categorie_index", methods={"GET"})
     */
    public function index(ForumCategorieRepository $forumCategorieRepository): Response
    {
        return $this->render('admin/forum_categorie/index.html.twig', [
            'forum_categories' => $forumCategorieRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="forum_categorie_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $forumCategorie = new ForumCategorie();
        $form = $this->createForm(ForumCategorieType::class, $forumCategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($forumCategorie);
            $entityManager->flush();

            return $this->redirectToRoute('forum_categorie_index');
        }

        return $this->render('admin/forum_categorie/new.html.twig', [
            'forum_categorie' => $forumCategorie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="forum_categorie_show", methods={"GET"})
     */
    public function show(ForumCategorie $forumCategorie): Response
    {
        return $this->render('admin/forum_categorie/show.html.twig', [
            'forum_categorie' => $forumCategorie,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="forum_categorie_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ForumCategorie $forumCategorie): Response
    {
        $form = $this->createForm(ForumCategorieType::class, $forumCategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('forum_categorie_index');
        }

        return $this->render('admin/forum_categorie/edit.html.twig', [
            'forum_categorie' => $forumCategorie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="forum_categorie_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ForumCategorie $forumCategorie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$forumCategorie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($forumCategorie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('forum_categorie_index');
    }
}
