<?php

namespace App\Controller\Admin;

use App\Entity\StrategieCategorie;
use App\Form\StrategieCategorieType;
use App\Repository\StrategieCategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/strategie/categorie")
 */
class StrategieCategorieController extends AbstractController
{
    /**
     * @Route("/", name="strategie_categorie_index", methods={"GET"})
     * @param StrategieCategorieRepository $strategieCategorieRepository
     * @return Response
     */
    public function index(StrategieCategorieRepository $strategieCategorieRepository): Response
    {
        return $this->render('admin\strategie_categorie/index.html.twig', [
            'strategie_categories' => $strategieCategorieRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="strategie_categorie_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $strategieCategorie = new StrategieCategorie();
        $form = $this->createForm(StrategieCategorieType::class, $strategieCategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($strategieCategorie);
            $entityManager->flush();

            return $this->redirectToRoute('strategie_categorie_index');
        }

        return $this->render('admin\strategie_categorie/new.html.twig', [
            'strategie_categorie' => $strategieCategorie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="strategie_categorie_show", methods={"GET"})
     * @param StrategieCategorie $strategieCategorie
     * @return Response
     */
    public function show(StrategieCategorie $strategieCategorie): Response
    {
        return $this->render('admin\strategie_categorie/show.html.twig', [
            'strategie_categorie' => $strategieCategorie,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="strategie_categorie_edit", methods={"GET","POST"})
     * @param Request $request
     * @param StrategieCategorie $strategieCategorie
     * @return Response
     */
    public function edit(Request $request, StrategieCategorie $strategieCategorie): Response
    {
        $form = $this->createForm(StrategieCategorieType::class, $strategieCategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('strategie_categorie_index');
        }

        return $this->render('admin\strategie_categorie/edit.html.twig', [
            'strategie_categorie' => $strategieCategorie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="strategie_categorie_delete", methods={"DELETE"})
     * @param Request $request
     * @param StrategieCategorie $strategieCategorie
     * @return Response
     */
    public function delete(Request $request, StrategieCategorie $strategieCategorie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$strategieCategorie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($strategieCategorie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('strategie_categorie_index');
    }
}
