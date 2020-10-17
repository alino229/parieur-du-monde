<?php

namespace App\Controller\Admin;

use App\Entity\CategoriePronostics;
use App\Form\CategoriePronosticsType;
use App\Repository\CategoriePronosticsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/categorie/pronostics")
 */
class CategoriePronosticsCrudController extends AbstractController
{
    /**
     * @Route("/", name="categorie_pronostics_index", methods={"GET"})
     */
    public function index(CategoriePronosticsRepository $categoriePronosticsRepository): Response
    {
        return $this->render('admin/categorie_pronostics/index.html.twig', [
            'categorie_pronostics' => $categoriePronosticsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="categorie_pronostics_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $categoriePronostic = new CategoriePronostics();
        $form = $this->createForm(CategoriePronosticsType::class, $categoriePronostic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($categoriePronostic);
            $entityManager->flush();

            return $this->redirectToRoute('categorie_pronostics_index');
        }

        return $this->render('admin/categorie_pronostics/new.html.twig', [
            'categorie_pronostic' => $categoriePronostic,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="categorie_pronostics_show", methods={"GET"})
     */
    public function show(CategoriePronostics $categoriePronostic): Response
    {
        return $this->render('admin/categorie_pronostics/show.html.twig', [
            'categorie_pronostic' => $categoriePronostic,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="categorie_pronostics_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CategoriePronostics $categoriePronostic): Response
    {
        $form = $this->createForm(CategoriePronosticsType::class, $categoriePronostic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('categorie_pronostics_index');
        }

        return $this->render('admin/categorie_pronostics/edit.html.twig', [
            'categorie_pronostic' => $categoriePronostic,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="categorie_pronostics_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CategoriePronostics $categoriePronostic): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categoriePronostic->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($categoriePronostic);
            $entityManager->flush();
        }

        return $this->redirectToRoute('categorie_pronostics_index');
    }
}
